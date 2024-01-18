<?php

namespace App\Controller;

use App\Entity\BowTvl;
use App\Service\ApplicationGlobalsService;
use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\FinContractCharts\Application\FinContractChartRequester;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;

class ApiController extends AbstractController
{
    private ApplicationGlobalsService $application_globals;

    #[Route('/')]
    public function homepage()
    {
        $response = 'KujiraTrack Backend: OK';
        return new JsonResponse($response);
    }

    #[Route('/volume/{precision}')]
    public function volume(ApplicationGlobalsService $applicationGlobalsService, string $precision = '1D')
    {
        $request = Request::createFromGlobals();
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $volume = [];
        $volume[] = $this->_all_fin_pair_volume($applicationGlobalsService, $precision, $from, $to);



        return new Response(
            json_encode(["totalVolume" => $volume]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/volume/{pair}')]

    public function volume_pair(ApplicationGlobalsService $application_globals, $pair)
    {

        $fin_urls = $application_globals->get_fin_contracts();
        $pair_value = $fin_urls[$pair];
        $volume = $this->_fin_pair_info($pair_value['contract'], '1D');
        return new Response(
            json_decode($volume),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );

    }
    #[Route('/finpairs')]

    public function fin_pairs(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {
        return $this->_get_fin_pairs();
    }

    #[Route('/bowtvl/{pair}')]
    public function bowTvl(EntityManagerInterface $entityManager, $pair)
    {
        //$usk_minted = $this->getEntityPerDay($entityManager, UskMinted::class);

        $bow_pairs = $entityManager->getRepository(BowTvl::class);

        $bow_pairs_all = $bow_pairs->findBy(["pair" => str_replace("_", "/", $pair)], ["tracked" => "ASC"], 200);
        $result = [];

        foreach($bow_pairs_all as $item) {
            $date = $item->getTracked()->format('Y-m-d');
            $pair = $item->getPair();
            $token = $item->getToken();
            $result[$pair][$date][$token] = [
                "token" => $token,
                "value" => $item->getBalance(),
                "time" => $item->getTracked()->format('Y-m-d'),
            ];
        }

        foreach ($result as &$pair) {
            $pair = array_values($pair);
        }

        // Return response
        return new Response(
            json_encode(["bowtvl" => $result]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    /* Calculations methods.*/

    private function _fin_pair_info(array $contract, string $precision, string $from, string $to)
    {

        $cache = new FilesystemAdapter();
        $value = $cache->get(str_replace([':','/'], '', "https://kaiyo-1.gigalixirapp.com/api/trades/candles?contract=" . $contract['contract'] . "&precision=". $precision . "&from=" . $from ."&to=". $to), function (ItemInterface $item) use ($contract, $precision, $from, $to) {
            $item->expiresAfter(3600);
            $client = HttpClient::create();
            $response = $client->request(
                'GET',
                "https://kaiyo-1.gigalixirapp.com/api/trades/candles?contract=" . $contract['contract'] . "&precision=". $precision . "&from=" . $from ."&to=". $to
            );

            return json_decode($response->getContent());
        });

        return $value;

    }

    private function _all_fin_pair_volume(ApplicationGlobalsService $applicationGlobalsService, $precision, $from, $to)
    {
        $fin_contracts = $applicationGlobalsService->get_fin_contracts();
        $volumes  = [[]];
        $nominatives =  $this->_get_nominatives();
        $nominativeCandles = [];

        for ($i = 0; $i < count($nominatives) ; $i++) {
            $nominativeCandles[$nominatives[$i]] = $this->_fin_pair_info($this->_get_contract($nominatives[$i]), $precision, $from, $to);
        }

        foreach ($fin_contracts as $key => $value) {
            $pairCandles = $this->_fin_pair_info($value, $precision, $from, $to);
            $candles = $pairCandles->candles;

            for ($i = 0 ; $i < count($candles); $i++) {
                $date = $candles[$i]->bin;
                $volumes[$i]['date'] = $date;

                if (!isset($volumes[$i]['volume'])) {
                    $volumes[$i]['volume'] = 0;
                }

                if (isset($value['nominative'])) {
                    $nominative_key = array_search($value["nominative"], $nominatives);
                    $nominative = $nominativeCandles[$nominatives[$nominative_key]];
                    isset($nominative->candles[$i]) ? $nominativeClosePrice = $nominative->candles[$i]->close : 0;
                    $volume_value = $candles[$i]->volume * $nominativeClosePrice;
                    $volumes[$i]['volume'] += isset($value['decimals']) ? $volume_value / ($value['decimals'] * 10) : $volume_value;
                } else {
                    $volumes[$i]['volume'] += isset($value['decimals']) ? $candles[$i]->volume / ($value['decimals'] * 10) : $candles[$i]->volume;
                }
            }
        }

        foreach ($volumes as &$volume) {
            $volume['volume'] /= 1000000;
        }

        return $volumes;
    }

    private function _get_fin_pairs()
    {
        $this->application_globals = new ApplicationGlobalsService();
        $fin_urls = $this->application_globals->get_fin_contracts();
        $pairs = array_keys($fin_urls);

        return new Response(
            json_decode($pairs),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );

    }

    private function _format_date($date)
    {
        $date = explode('T', $date);
        return $date[0];
    }

    private function _get_contract($ticker)
    {
        $this->application_globals = new ApplicationGlobalsService();
        $contracts = $this->application_globals->get_fin_contracts();
        return $contracts[$ticker];
    }

    private function _get_nominatives()
    {
        $this->application_globals = new ApplicationGlobalsService();
        $contracts = $this->application_globals->get_fin_contracts();
        $nominative_tickers = [];
        foreach ($contracts as $contract) {
            if(isset($contract['nominative'])) {
                if(!in_array($contract['nominative'], $nominative_tickers)) {
                    $nominative_tickers[] = $contract['nominative'];
                }
            }
        }
        return $nominative_tickers;
    }


}

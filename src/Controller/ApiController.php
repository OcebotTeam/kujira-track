<?php

namespace App\Controller;

use App\Entity\BowTvl;
use App\Entity\StakedManta;
use App\Entity\StakedTokens;
use App\Entity\Transactions;
use App\Entity\Unmigrated;
use App\Entity\UskMinted;
use App\Entity\Wallets;
use App\Repository\BowTvlRepository;
use App\Service\ApplicationGlobalsService;
use DateInterval;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Class_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Contracts\Cache\ItemInterface;


class ApiController extends AbstractController
{
    private ApplicationGlobalsService $application_globals;
    #[Route('/')]
    public function homepage()
    {
        $volume =$this->_volume('kujira14hj2tavq8fpesdwxxcu44rty3hh90vhujrvcmstl4zr3txmfvw9sl4e867','1D');

        return new Response(
            $volume,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }











    #[Route('/volume/{precision}')]

    public function volume (ApplicationGlobalsService $application_globals, string $precision = '1D'){

        $volume = [];

        $volume[] = $this->_all_fin_pair_volume($application_globals, $precision);


        //$cache = new FilesystemAdapter();
        //$value = $cache->get(str_replace([':','/'], '',"https://api.kujira.app/api/trades/candles?" .  $_SERVER['QUERY_STRING']), function (ItemInterface $item) {
        // $item->expiresAfter(20);



        return new Response(
            json_encode(["FIN CONTRACTS" => $volume]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );


    }

    #[Route('/volume/{pair}')]

    public function volume_pair (ApplicationGlobalsService $application_globals, $pair){

        $fin_urls = $application_globals->get_fin_contracts();
        $pair_value = $fin_urls[$pair];
        $volume = $this->_fin_pair_volume($pair_value['contract'],'1D');
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

    public function fin_pairs (EntityManagerInterface $entityManager,ApplicationGlobalsService $application_globals){

        return $this->_get_fin_pairs();

    }

    #[Route('/bowtvl/{pair}')]
    public function bowTvl(EntityManagerInterface $entityManager, $pair)
    {
        //$usk_minted = $this->getEntityPerDay($entityManager, UskMinted::class);

        $bow_pairs = $entityManager->getRepository(BowTvl::class);

        $bow_pairs_all = $bow_pairs->findBy(["pair" => str_replace("_","/",$pair)], ["tracked" => "ASC"],200);
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

    /*********************************
     *  KUJIRA Proxy routes
     *********************************/



    /* Calculations methods.*/

    private function _fin_pair_volume(string $contract, string $precision)  {

        //Format date = '2022-11-29T13:00:00.000Z'
        $end_date = new DateTime('now');
        $end_date_parameter = $end_date->format(DateTimeInterface::ISO8601);
        $start_date = $end_date->sub(new DateInterval('P1Y'));
        $start_date_parameter = $start_date->format(DateTimeInterface::ISO8601);
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://kaiyo-1.gigalixirapp.com/api/trades/candles?contract=" . $contract . "&precision=". $precision . "&from=" . str_replace('+','.',$start_date_parameter) ."&to=". str_replace('+','.',$end_date_parameter)
        );
            return json_decode($response->getContent());

    }

    private function _all_fin_pair_volume(ApplicationGlobalsService $applicationGlobalsService, $precision = '1D') {
        $fin_contracts = $applicationGlobalsService->get_fin_contracts();

        $volume  = [];
        $volume[] = [];

        foreach ($fin_contracts as $key => $value){
            foreach($this->_fin_pair_volume($value['contract'],$precision) as $pairVolume){
                dump ($pairVolume);
               for ($i = 0 ; $i < count($pairVolume); $i++){
                    $volume[$i]['date'] = 0;
                    $volume[$i]['volume'] = 0;
                }

                for ($i = 0 ; $i < count($pairVolume); $i++){
                    $date = $this->_format_date($pairVolume[$i]->bin);
                    $volume[$i]['date'] = $date;
                    $volume[$i]['volume'] += $pairVolume[$i]->volume ;
                }

            }

        }
        dump($volume);

        //return $all_candles;
    }

    private function _get_fin_pairs(){
        $this->application_globals = new ApplicationGlobalsService();
        $fin_urls = $this->application_globals->get_fin_contracts();
        $pairs = array_keys($fin_urls);

        return new Response(
            json_decode ($pairs),
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


}

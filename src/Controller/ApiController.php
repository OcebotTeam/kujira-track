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
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Class_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\ItemInterface;


class ApiController extends AbstractController
{
    private function getEntityPerDay(EntityManagerInterface $entityManager, $class) {
        $entity_repo = $entityManager->getRepository($class);
        $all_enities = $entity_repo->findBy([], ["tracked" => "ASC"]);
        $prev_day_date = null;

        // Filter to get just 1 record per day
        return array_filter($all_enities, function($item) use (&$prev_day_date) {
            $item_date = $item->getTracked();

            if (is_null($prev_day_date) || $item_date->format('Y-m-d') != $prev_day_date->format('Y-m-d')) {
                $prev_day_date = $item_date;
                return true;
            }

            return false;
        });
    }

    #[Route('/')]
    public function homepage()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://lcd.kaiyo.kujira.setten.io/cosmos/distribution/v1beta1/community_pool'
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/wallets')]
    public function wallets(EntityManagerInterface $entityManager)
    {
        $wallets = $this->getEntityPerDay($entityManager, Wallets::class);

        // Format key/values to meet the front needs.
        $formatted_wallets = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $wallets);

        // Return response
        return new Response(
            json_encode(["wallets" => array_values($formatted_wallets)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/transactions')]
    public function transactions(EntityManagerInterface $entityManager)
    {
        $transactions = $this->getEntityPerDay($entityManager, Transactions::class);

        // Format key/values to meet the front needs.
        $filtered_transactions = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $transactions);

        // Return response
        return new Response(
            json_encode(["transactions" => array_values($filtered_transactions)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/unmigrated')]
    public function unmigrated(EntityManagerInterface $entityManager)
    {
        $unmigrated_tokens = $this->getEntityPerDay($entityManager, Unmigrated::class);

        // Format key/values to meet the front needs.
        $filtered_unmigrated_tokens = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $unmigrated_tokens);

        // Return response
        return new Response(
            json_encode(["unmigrated" => array_values($filtered_unmigrated_tokens)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/stakedtokens')]
    public function stakedTokens(EntityManagerInterface $entityManager)
    {
        $staked_tokens = $this->getEntityPerDay($entityManager, StakedTokens::class);

        // Format key/values to meet the front needs.
        $filtered_staked_tokens = array_map(function ($item) {
            return [
                "value" => $item->getBondedTokens(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $staked_tokens);

        // Return response
        return new Response(
            json_encode(["stakedtokens" => array_values($filtered_staked_tokens)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/mantastaked')]
    public function mantaStaked(EntityManagerInterface $entityManager)
    {
        $manta_staked = $this->getEntityPerDay($entityManager, StakedManta::class);

        // Format key/values to meet the front needs.
        $filtered_manta_staked = array_map(function ($item) {
            return [
                "value" => $item->getBonded(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $manta_staked);

        // Return response
        return new Response(
            json_encode(["mantastaked" => array_values($filtered_manta_staked)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/uskminted')]
    public function uskMinted(EntityManagerInterface $entityManager)
    {
        $usk_minted = $this->getEntityPerDay($entityManager, UskMinted::class);

        // Format key/values to meet the front needs.
        $filtered_usk_minted = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $usk_minted);

        // Return response
        return new Response(
            json_encode(["uskminted" => array_values($filtered_usk_minted)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('v2/uskminted')]
    public function uskMintedv2(EntityManagerInterface $entityManager)
    {
        //$usk_minted = $this->getEntityPerDay($entityManager, UskMinted::class);

        $usk_minted_repo = $entityManager->getRepository(UskMinted::class);
        $usk_minted_all = $usk_minted_repo->findBy([], ["tracked" => "ASC"]);
        $result = [];

        foreach($usk_minted_all as $item) {
            $date = $item->getTracked()->format('Y-m-d');
            $collateral = $item->getCollateral();
            $result[$collateral][$date] = [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }

        foreach ($result as &$collateral) {
            $collateral = array_values($collateral);
        }

        // Return response
        return new Response(
            json_encode(["uskminted" => $result]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
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

    #[Route('/kbridge/candles')]
    public function kbridge_candles()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://kaiyo-1.gigalixirapp.com/api/trades/candles?" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/kbridge/cached/candles')]
    public function kbridge_cached_candles(){

        $cache = new FilesystemAdapter();
        $value = $cache->get(str_replace([':','/'], '',"https://api.kujira.app/api/trades/candles?" .  $_SERVER['QUERY_STRING']), function (ItemInterface $item) {
        $item->expiresAfter(20);

        // ... do some HTTP request or heavy computations
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://kaiyo-1.gigalixirapp.com/api/trades/candles?" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    });
    return $value;

    }

    #[Route('/kbridge/txs/count')]
    public function kbridge_txs_count()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://kaiyo-1.gigalixirapp.com/api/txs/count?" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/kbridge/staking/pool')]
    public function kbridge_staking_pool()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://lcd.kaiyo.kujira.setten.io/cosmos/staking/v1beta1/pool?" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/kbridge/coingecko/tickers')]
    public function kbridge_coingecko_tickers()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.kujira.app/api/coingecko/tickers" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/kbridge/coingecko/orderbook')]
    public function kbridge_coingecko_orderbook()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.kujira.app/api/coingecko/orderbook?" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('/kbridge/trades')]
    public function kbridge_trades()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.kujira.app/api/trades?" . $_SERVER['QUERY_STRING']
        );

        return new Response(
            $response->getContent(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }



}

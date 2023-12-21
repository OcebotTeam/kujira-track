<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;

class BridgeController extends AbstractController
{
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
    public function kbridge_cached_candles()
    {

        $cache = new FilesystemAdapter();
        $value = $cache->get(str_replace([':','/'], '', "https://api.kujira.app/api/trades/candles?" .  $_SERVER['QUERY_STRING']), function (ItemInterface $item) {
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

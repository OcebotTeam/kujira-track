<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Infraestructure;

use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandle;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandles;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinContractCandlesServiceLcd implements FinContractCandlesService
{
    public const CANDLES_ENDPOINT = "https://kaiyo-1.gigalixirapp.com/api/trades/candles";

    public function __construct(private HttpClientInterface $httpClient, private CacheInterface $cache)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
    }


    public function requestCandles(string $address, string $timeframe, string $from, string $to): FinContractCandles
    {
        $responseContent =  $this->cache->get('candles_' . $address, function (ItemInterface $item) use ($address, $timeframe, $from, $to) {
        $response = $this->httpClient->request('GET', self::CANDLES_ENDPOINT, [
            "query"  => [
                "contract" => $address,
                "precision" => $timeframe,
                "from" => $from,
                "to" => $to
            ]
        ]);

            $item->expiresAfter(1800); // 1800 segundos = 30 minutos


            return $response->getContent();
    });

        $candlesArray = [];
        $responseContent = json_decode($responseContent);

        foreach ($responseContent->candles as $candle) {
            $candlesArray[] = new FinContractCandle(
                (float) $candle->low,
                (float) $candle->high,
                (float) $candle->close,
                (float) $candle->open,
                $candle->bin,
                (int) $candle->volume
            );
        }

        return new FinContractCandles($candlesArray);
    }
}

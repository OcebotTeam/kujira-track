<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Infrastructure;

use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandle;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandleDateTime;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandles;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Ocebot\KujiraTrack\FinContractCharts\Domain\TimeFrame;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinContractCandlesServiceLcdCached implements FinContractCandlesService
{
    private const CANDLES_ENDPOINT = "https://kaiyo-1.gigalixirapp.com/api/trades/candles";

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly CacheInterface $cache
    ){
    }


    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinContractCandles
    {
        $cacheKey = md5($address->value() . $timeframe->apiKey() . $page);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($address, $timeframe, $page) {
            $item->expiresAfter(1800); // Cache for 30 minutes

            $toAmountBack = -$page * self::BATCH_SIZE;
            $fromAmountBack = $toAmountBack - self::BATCH_SIZE + 1;

            $fromDate = new FinContractCandleDateTime($fromAmountBack . ' ' . $timeframe->dateTimeKey());
            $toDate = new FinContractCandleDateTime($toAmountBack . ' ' . $timeframe->dateTimeKey());

            $response = $this->httpClient->request('GET', self::CANDLES_ENDPOINT, [
                "query"  => [
                    "contract" => $address->value(),
                    "precision" => $timeframe->apiKey(),
                    "from" => $fromDate->value(),
                    "to" => $toDate->value(),
                ]
            ]);

            $candlesArray = [];
            $responseContent = json_decode($response->getContent());

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
        });
    }
}

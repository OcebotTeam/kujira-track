<?php

namespace Ocebot\KujiraTrack\FinCandles\Infrastructure;

use Ocebot\KujiraTrack\FinCandles\Domain\FinCandle;
use Ocebot\KujiraTrack\FinCandles\Domain\FinCandles;
use Ocebot\KujiraTrack\FinCandles\Domain\FinCandlesService;
use Ocebot\KujiraTrack\FinCandles\Domain\TimeFrame;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Shared\Domain\DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinCandlesServiceLcd implements FinCandlesService
{
    private const CANDLES_ENDPOINT = "https://kaiyo-1.gigalixirapp.com/api/trades/candles";

    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {
    }


    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinCandles
    {

        $toAmountBack = -$page * self::BATCH_SIZE;
        $fromAmountBack = $toAmountBack - self::BATCH_SIZE + 1;

        $fromDate = new DateTime($fromAmountBack . ' ' . $timeframe->dateTimeKey());
        $toDate = new DateTime($toAmountBack . ' ' . $timeframe->dateTimeKey());

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
            $candlesArray[] = new FinCandle(
                (float) $candle->low,
                (float) $candle->high,
                (float) $candle->close,
                (float) $candle->open,
                $candle->bin,
                (int) $candle->volume
            );
        }

        return new FinCandles($candlesArray);
    }
}

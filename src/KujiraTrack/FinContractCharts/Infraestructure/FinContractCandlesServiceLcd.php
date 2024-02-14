<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Infraestructure;

use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandle;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandleDateTime;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandles;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Ocebot\KujiraTrack\FinContractCharts\Domain\TimeFrame;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinContractCandlesServiceLcd implements FinContractCandlesService
{
    private const CANDLES_ENDPOINT = "https://kaiyo-1.gigalixirapp.com/api/trades/candles";

    public function __construct(private HttpClientInterface $httpClient)
    {
    }


    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinContractCandles
    {
        $fromDate = new FinContractCandleDateTime(-$page-self::BATCH_SIZE . ' ' . $timeframe->dateTimeKey());
        $toDate = new FinContractCandleDateTime(-$page . ' ' . $timeframe->dateTimeKey());

        $response = $this->httpClient->request('GET', self::CANDLES_ENDPOINT, [
            "query"  => [
                "contract" => $address->value(),
                "precision" => $timeframe->apiKey(),
                "from" => $fromDate->value(),
                "to" => $toDate->value(),
            ]
        ]);

        $responseContent = json_decode($response->getContent());
        $candlesArray = [];

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

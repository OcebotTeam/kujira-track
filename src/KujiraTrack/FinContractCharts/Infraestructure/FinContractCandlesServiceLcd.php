<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Infraestructure;

use DateTime;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandles;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Ocebot\KujiraTrack\FinContractCharts\Domain\TimeFrame;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class FinContractCandlesServiceLcd implements FinContractCandlesService
{
    const CANDLES_ENDPOINT = "https://kaiyo-1.gigalixirapp.com/api/trades/candles";

    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }


    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, string $from, string $to): FinContractCandles
    {
        $response = $this->httpClient->request('GET', self::CANDLES_ENDPOINT, [
            "query"  => [
                "contract" => $address->value(),
                "precision" => $timeframe->precision(),
                "from" => $from,
                "to" => $to
            ]
        ]);

        return new FinContractCandles([]);
    }
}
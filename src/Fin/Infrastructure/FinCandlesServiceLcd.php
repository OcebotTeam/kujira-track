<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

use Ocebot\KujiraTrack\Fin\Domain\FinCandle;
use Ocebot\KujiraTrack\Fin\Domain\FinCandleCollection;
use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\TimeFrame;
use Ocebot\KujiraTrack\Shared\Domain\KtDateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinCandlesServiceLcd implements FinCandlesService
{
    private const CANDLES_ENDPOINT = "https://kaiyo-1.gigalixirapp.com/api/trades/candles";

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly FinContractRepository $finContractRepository
    ) {
    }

    public function request(FinContractAddress $address, TimeFrame $timeframe, int $page): FinCandleCollection
    {
        $toAmountBack = -$page * self::BATCH_SIZE;
        $fromAmountBack = $toAmountBack - self::BATCH_SIZE + 1;
        $contractFinder = $this->finContractRepository->findByAddress($address);

        $fromDate = new KtDateTime($fromAmountBack . ' ' . $timeframe->dateTimeKey());
        $toDate = new KtDateTime($toAmountBack . ' ' . $timeframe->dateTimeKey());

        $response = $this->httpClient->request('GET', self::CANDLES_ENDPOINT, [
            "query"  => [
                "contract" => $address->value(),
                "precision" => $timeframe->apiKey(),
                "from" => $fromDate->dateValue(),
                "to" => $toDate->dateValue(),
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
                (int) $candle->volume / 10 ** $contractFinder->decimals(),
                $candle->bin
            );
        }

        return new FinCandleCollection($candlesArray);
    }
}

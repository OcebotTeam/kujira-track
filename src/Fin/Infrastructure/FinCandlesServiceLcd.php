<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

use DateTime;
use Ocebot\KujiraTrack\Fin\Domain\FinCandle;
use Ocebot\KujiraTrack\Fin\Domain\FinCandleCollection;
use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\Timeframe;
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

    public function request(FinContractAddress $address, Timeframe $timeframe, int $page): FinCandleCollection
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

        $rawCandleValues = json_decode($response->getContent());

        // Construct proper dates array to be fulfilled
        $datesRange = $this->getDatesRange($fromDate->dateValue(), $toDate->dateValue(), $timeframe);

        // Add the candles to the dates array
        foreach ($rawCandleValues->candles as $candle) {
            $candleDate = new DateTime($candle->bin);
            $candleDateFormatted = $candleDate->format('Y-m-d');

            $datesRange[$candleDateFormatted] = new FinCandle(
                (float) $candle->low,
                (float) $candle->high,
                (float) $candle->close,
                (float) $candle->open,
                (int) $candle->volume,
                $candle->bin
            );
        }

        // Close date range gaps
        $prevCandle = null;
        foreach ($datesRange as $date => $value) {
            if (!$value instanceof FinCandle && is_null($prevCandle)) {
                $datesRange[$date] = new FinCandle(0, 0, 0, 0, 0, $date);
            }

            if (!$value instanceof FinCandle && $prevCandle instanceof FinCandle) {
                $datesRange[$date] = new FinCandle(
                    $prevCandle->closePrice(),
                    $prevCandle->closePrice(),
                    $prevCandle->closePrice(),
                    $prevCandle->closePrice(),
                    0,
                    $date
                );
            }

            $prevCandle = $datesRange[$date];
        }

        return new FinCandleCollection(array_values($datesRange));
    }


    private function getDatesRange(string $fromDate, string $toDate, Timeframe $timeframe): array
    {
        $dates = [];
        $currentDate = strtotime($fromDate);
        $endDate = strtotime($toDate);

        while ($currentDate <= $endDate) {
            $dateString = date("Y-m-d", $currentDate);
            $dates[$dateString] = $dateString;
            $currentDate = strtotime("+1 " . $timeframe->dateTimeKey(), $currentDate);
        }

        return $dates;
    }
}

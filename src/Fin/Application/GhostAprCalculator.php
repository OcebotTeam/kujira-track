<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\TimeframeFactory;
use Ocebot\KujiraTrack\Fin\Domain\FinCandle;

final class GhostAprCalculator
{
    public function __construct(
        private readonly FinCandlesService $service,
    )
    {
    }

    public function __invoke(string $address, string $timeframe, int $page): array
    {
        $timeframe = TimeframeFactory::build($timeframe);
        $finContractAddress = new FinContractAddress($address);
        $candles = $this->service->request($finContractAddress, $timeframe, $page);
        $timeFrameAPR = [];

        foreach ($candles as $candle) {
            if ($candle instanceof FinCandle) {
                $time = $candle->time();
                $month = date($timeframe->format(), $time);
                $timeFrameAPR[$month]['time'] = $month;
                if ($candle->openPrice() != 0) {
                    $increment = ($candle->closePrice() - $candle->openPrice()) / $candle->openPrice();
                    $timeFrameAPR[$month]['month_increments'] = (($candle->closePrice() - $candle->openPrice()) / $candle->openPrice()) * 100;
                    $timeFrameAPR[$month]['apr'] = (((1 + $increment) ** 12) - 1) * 100;
                } else {
                    $timeFrameAPR[$month]['apr'] = 0;
                }
            }
        }
        return array_values($timeFrameAPR);
    }
}
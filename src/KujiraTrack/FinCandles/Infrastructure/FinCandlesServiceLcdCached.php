<?php

namespace Ocebot\KujiraTrack\FinCandles\Infrastructure;

use Ocebot\KujiraTrack\FinCandles\Domain\FinCandles;
use Ocebot\KujiraTrack\FinCandles\Domain\TimeFrame;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinCandlesServiceLcdCached extends FinCandlesServiceLcd
{
    public function __construct(
        HttpClientInterface $httpClient,
        private readonly CacheInterface $cache
    ) {
        parent::__construct($httpClient);
    }


    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinCandles
    {
        $cacheKey = md5($address->value() . $timeframe->apiKey() . $page);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($address, $timeframe, $page) {

            // TODO: invalidate cache at the begining of the day
            // so candles doens't overlap when loading pages of different days

            // Cache for 30 minutes
            $item->expiresAfter(1800);

            // Call the parent method and cache its result
            $result = parent::requestCandles($address, $timeframe, $page);

            return $result;
        });
    }
}
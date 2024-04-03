<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Infrastructure;

use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandles;
use Ocebot\KujiraTrack\FinContractCharts\Domain\TimeFrame;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinContractCandlesServiceLcdCached extends FinContractCandlesServiceLcd
{
    public function __construct(
        HttpClientInterface $httpClient,
        private readonly CacheInterface $cache
    ){
        parent::__construct($httpClient);
    }


    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinContractCandles
    {
        $cacheKey = md5($address->value() . $timeframe->apiKey() . $page);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($address, $timeframe, $page) {
            $item->expiresAfter(1800); // Cache for 30 minutes

            // Call the parent method and cache its result
            $result = parent::requestCandles($address, $timeframe, $page);

            return $result;
        });
    }
}

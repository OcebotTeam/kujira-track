<?php

namespace Ocebot\KujiraTrack\Tokens\Infrastructure;

use Ocebot\KujiraTrack\Tokens\Domain\TokenPriceService;
use Ocebot\KujiraTrack\Tokens\Domain\TokenSymbol;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TokenPriceServiceCoinGecko implements TokenPriceService
{
    const COIN_LIST_API_URL = 'https://api.coingecko.com/api/v3/coins/list';
    //const PRICE_API_URL = 'https://api.coingecko.com/api/v3/simple/price';
    const PRICE_API_URL = 'https://api.kujira.app/api/coingecko/api/v3/simple/price';

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    private function getCoinGeckoId(string $symbol): string
    {
        $cache = new FilesystemAdapter();
        $coinList = $cache->getItem('coin_gecko.coin_list');

        // If the cache is empty, we fetch the coin list from the API
        if (!$coinList->isHit()) {
            $response = $this->httpClient->request('GET', self::COIN_LIST_API_URL);
            $coinList->set(json_decode($response->getContent()));
            $cache->save($coinList);
        }

        $match = array_filter($coinList->get(), fn($coin) => $coin->symbol === strtolower($symbol));
        $match = reset($match);
        return $match->id;
    }

    public function price(TokenSymbol $ticker): float
    {
        $coinGeckoId = $this->getCoinGeckoId($ticker->value());
        $response = $this->httpClient->request('GET', self::PRICE_API_URL, [
            'query'  => [
                'vs_currencies' => 'usd',
                'ids' => $coinGeckoId
            ]
        ]);

        $content = json_decode($response->getContent());
        return $content->{$coinGeckoId}->usd;
    }
}
<?php

namespace Ocebot\KujiraTrack\Staking\Infrastructure;

use DateTimeImmutable;
use Ocebot\KujiraTrack\Staking\Domain\StakedKuji;
use Ocebot\KujiraTrack\Staking\Domain\StakedKujiService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StakedKujiServiceLcd implements StakedKujiService
{
    private const STAKED_KUJI_ENDPOINT = 'https://lcd.kaiyo.kujira.setten.io/cosmos/staking/v1beta1/pool';

    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {
    }

    public function request(): StakedKuji
    {
        $response = $this->httpClient->request('GET', self::STAKED_KUJI_ENDPOINT);
        $content = json_decode($response->getContent());
        $currentDateTime = new DateTimeImmutable();

        return new StakedKuji(
            $currentDateTime->format('Y-m-d H:i:s'),
            $content->pool->bonded_tokens,
            $content->pool->not_bonded_tokens
        );
    }
}

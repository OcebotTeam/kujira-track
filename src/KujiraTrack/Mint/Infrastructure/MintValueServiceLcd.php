<?php

namespace Ocebot\KujiraTrack\Mint\Infrastructure;

use DateTimeImmutable;

use Ocebot\KujiraTrack\Mint\Domain\MintValue;
use Ocebot\KujiraTrack\Mint\Domain\MintValueService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MintValueServiceLcd implements MintValueService
{
    private const MINT_ENDPOINT = 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/';
    private const MINT_QUERY = '/smart/eyJzdGF0dXMiOnt9fQ==';

    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {
    }

    public function request(string $contractAddress): MintValue
    {
        $response = $this->httpClient->request('GET', self::MINT_ENDPOINT . $contractAddress . self::MINT_QUERY);
        $content = json_decode($response->getContent());
        $currentDateTime = new DateTimeImmutable();

        return new MintValue(
            $content->data->debt_amount,
            $currentDateTime->format('Y-m-d H:i:s')
        );
    }
}

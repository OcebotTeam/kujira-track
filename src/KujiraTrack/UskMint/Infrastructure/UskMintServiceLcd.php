<?php

namespace Ocebot\KujiraTrack\UskMint\Infrastructure;

use DateTimeImmutable;

use Ocebot\KujiraTrack\UskMint\Domain\UskMintCollection;
use Ocebot\KujiraTrack\UskMint\Domain\UskMintService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UskMintServiceLcd implements UskMintService
{
    private const USKMINT_ENDPOINT = 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/';
    private const USKMINT_QUERY = '/smart/eyJzdGF0dXMiOnt9fQ==';

    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {
    }

    public function request(string $contract): UskMint
    {

            $response = $this->httpClient->request('GET', self::USKMINT_ENDPOINT . $contract . self::USKMINT_QUERY);
            $content = json_decode($response->getContent());
            $currentDateTime = new DateTimeImmutable();
            return  new UskMint(
                $currentDateTime->format('Y-m-d H:i:s'),
                $content->data->debt_amount,
            );

    }
}

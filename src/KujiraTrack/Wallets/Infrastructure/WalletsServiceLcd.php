<?php

namespace Ocebot\KujiraTrack\Wallets\Infrastructure;

use DateTimeImmutable;
use Ocebot\KujiraTrack\Wallets\Domain\Wallets;
use Ocebot\KujiraTrack\Wallets\Domain\WalletsService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WalletsServiceLcd implements WalletsService
{
  private const WALLETS_ENDPOINT = 'https://lcd.kaiyo.kujira.setten.io/cosmos/auth/v1beta1/accounts?pagination.limit=1&pagination.count_total=true';

  public function __construct(
    private readonly HttpClientInterface $httpClient
  ) {
  }

  public function request(): Wallets
  {
    $response = $this->httpClient->request('GET', self::WALLETS_ENDPOINT);
    $content = json_decode($response->getContent());
    $currentDateTime = new DateTimeImmutable();

    return new Wallets(
      $currentDateTime->format('Y-m-d H:i:s'),
      $content->pagination->total
    );
  }
}

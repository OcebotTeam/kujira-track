<?php

namespace Ocebot\KujiraTrack\Tokens\Application;

use Ocebot\KujiraTrack\Tokens\Domain\TokenRepository;

final class TokenFinder
{
    public function __construct(private readonly TokenRepository $tokenRepository)
    {
    }


    public function __invoke(string $tokenTicker): array
    {
        $token = $this->tokenRepository->findByTicker($tokenTicker);

        return [
            'symbol' => $token->symbol(),
            'ibc' => $token->ibc(),
        ];
    }
}
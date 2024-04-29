<?php

namespace Ocebot\KujiraTrack\Tokens\Application;

use Ocebot\KujiraTrack\Tokens\Domain\Token;
use Ocebot\KujiraTrack\Tokens\Domain\TokenRepository;

final class TokenLister
{
    public function __construct(private readonly TokenRepository $tokenRepository)
    {
    }

    public function __invoke(): array
    {
        $tokens = $this->tokenRepository->findAll();

        return array_map(function (Token $token) {
            return [
                'symbol' => $token->symbol(),
                'ibc' => $token->ibc(),
            ];
        }, iterator_to_array($tokens));
    }

}

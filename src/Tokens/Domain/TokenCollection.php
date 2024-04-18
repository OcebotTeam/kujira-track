<?php

namespace Ocebot\KujiraTrack\Tokens\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

final class TokenCollection extends Collection
{
    protected function type(): string
    {
        return Token::class;
    }
}

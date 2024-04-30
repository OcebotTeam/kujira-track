<?php

namespace Ocebot\KujiraTrack\Tokens\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;

final class TokenNotFoundError extends DomainError
{
    public function __construct(
        private readonly string $identifier
    ) {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'token_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('Token <%s> has not been found', $this->identifier);
    }
}

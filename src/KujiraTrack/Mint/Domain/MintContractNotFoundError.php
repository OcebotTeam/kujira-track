<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;

final class MintContractNotFoundError extends DomainError
{
    public function __construct(
        private readonly string $token
    ) {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'Collateral not found';
    }

    protected function errorMessage(): string
    {
        return sprintf('Mint contract for "%s" has not been found', $this->token);
    }
}

<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;

final class GhostContractNotFoundError extends DomainError
{
    public function __construct(
        private readonly string $identifier
    ) {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'fin_contract_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('Ghost contract <%s> has not been found', $this->identifier);
    }
}

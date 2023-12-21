<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;
use RuntimeException;

final class FinContractNotFound extends DomainError
{
    public function __construct(private readonly string $tickerId)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'fin_contract_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('FIN contract with ticker ID <%s> has not been found', $this->tickerId);
    }
}


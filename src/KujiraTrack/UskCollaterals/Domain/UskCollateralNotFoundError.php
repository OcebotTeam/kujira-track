<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;

final class UskCollateralNotFoundError extends DomainError
{
    public function __construct(private readonly string $token)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'Collateral not found';
    }

    protected function errorMessage(): string
    {
        return sprintf('USK collaterals with the token <%s> has not been found', $this->token);
    }
}

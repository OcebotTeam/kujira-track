<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Application;

use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollateralNotFoundError;
use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollateralRepository;

final class UskCollateralFinder
{
    public function __construct(private readonly UskCollateralRepository $repository)
    {
    }

    public function __invoke(string $token): array
    {
        $collateral = $this->repository->findByToken($token);

        if (is_null($collateral)) {
            throw new UskCollateralNotFoundError($token);
        }

        return [
            'contract' =>    $collateral->contract(),
            'token' =>   $collateral->token(),
            'margin' =>   $collateral->isMargin(),
        ];
    }
}

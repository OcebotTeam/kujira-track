<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Application;

use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollateral;
use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollateralRepository;

final class UskCollateralLister
{
    public function __construct(private readonly UskCollateralRepository $repository)
    {
    }

    public function __invoke(): array
    {
        $UskCollateral = $this->repository->findAll();

        return array_map(
            fn (UskCollateral $UskCollateral) => [
                'address' => $UskCollateral->contract(),
                'token' => $UskCollateral->token(),
                'margin' => $UskCollateral->isMargin(),
            ],
            iterator_to_array($UskCollateral)
        );
    }
}

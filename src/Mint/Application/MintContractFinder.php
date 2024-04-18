<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintContractNotFoundError;
use Ocebot\KujiraTrack\Mint\Domain\MintContractRepository;

final class MintContractFinder
{
    public function __construct(private readonly MintContractRepository $repository)
    {
    }

    public function __invoke(string $collateral): array
    {
        $mintContract = $this->repository->findByCollateral($collateral);

        if (is_null($mintContract)) {
            throw new MintContractNotFoundError($collateral);
        }

        return [
            'address' =>    $mintContract->address(),
            'collateral' =>   $mintContract->collateral(),
            'margin' =>   $mintContract->isMargin(),
        ];
    }
}

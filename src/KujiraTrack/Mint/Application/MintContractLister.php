<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintContract;
use Ocebot\KujiraTrack\Mint\Domain\MintContractRepository;

final class MintContractLister
{
    public function __construct(private readonly MintContractRepository $repository)
    {
    }

    public function __invoke(): array
    {
        $mintContractCollection = $this->repository->findAll();

        return array_map(
            fn (MintContract $mintContract) => [
                'address' => $mintContract->contract(),
                'collateral' => $mintContract->collateral(),
                'margin' => $mintContract->isMargin(),
            ],
            iterator_to_array($mintContractCollection)
        );
    }
}

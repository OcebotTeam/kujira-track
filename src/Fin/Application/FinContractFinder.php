<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContractNotFoundError;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;

final class FinContractFinder
{
    public function __construct(private readonly FinContractRepository $repository)
    {
    }

    public function __invoke(string $tickerId): array
    {
        $finContract = $this->repository->findByTickerId(new FinContractTickerId($tickerId));

        if (is_null($finContract)) {
            throw new FinContractNotFoundError($tickerId);
        }

        return [
            'address' => $finContract->address(),
            'tickerId' => $finContract->tickerId(),
            'volumeDivider' => $finContract->volumeDivider(),
            'priceDivider' => $finContract->priceDivider(),
            'nominative' => $finContract->nominative(),
        ];
    }
}

<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\GhostContractNotFoundError;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;

final class GhostContractFinder
{
    public function __construct(
        private readonly FinContractRepository $repository
    ) {
    }

    public function __invoke(string $token): array
    {
        $tickerId = new FinContractTickerId($token);
        $finContract = $this->repository->findByTickerId($tickerId);

        if (is_null($finContract)) {
            throw new GhostContractNotFoundError($tickerId);
        }

        return [
            'address' => $finContract->address(),
            'token' => $finContract->tickerId()
        ];
    }
}

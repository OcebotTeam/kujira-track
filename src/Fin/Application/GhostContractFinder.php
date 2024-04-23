<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContractNotFoundError;
use Ocebot\KujiraTrack\Fin\Domain\GhostContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\GhostContractToken;

final class GhostContractFinder
{
    public function __construct(private readonly GhostContractRepository $repository)
    {
    }

    public function __invoke(string $token): array
    {
        $ghostContract = $this->repository->findByToken(new GhostContractToken($token));

        if (is_null($ghostContract)) {
            throw new FinContractNotFoundError($token);
        }

        return [
            'address' => $ghostContract->address(),
            'token' => $ghostContract->token()
        ];
    }
}

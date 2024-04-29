<?php

namespace Ocebot\KujiraTrack\Fin\Application;


use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;
use Ocebot\KujiraTrack\Fin\Domain\Service\FinCandlesUsdVolumeCalculator;

final class FinContractUsdVolumeObtainer
{
    public function __construct(
        private readonly FinContractRepository $repository,
        private readonly FinCandlesUsdVolumeCalculator $calculator
    ) {
    }

    public function __invoke(string $tickerId,string $timeframe, int $page): array
    {
        $tickerId = new FinContractTickerId($tickerId);
        $contract = $this->repository->findByTickerId($tickerId);
        return $this->calculator->__invoke($contract->address(), $timeframe, $page);
    }
}

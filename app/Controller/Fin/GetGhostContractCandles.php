<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinCandlesLister;
use Ocebot\KujiraTrack\Fin\Application\GhostContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetGhostContractCandles extends AbstractController
{
    public function __construct(
        private readonly GhostContractFinder $contractFinder,
        private readonly FinCandlesLister $candlesObtainer
    ) {
    }

    #[Route('/ghost/contracts/{token}/candles', name: 'ghost_contract_candles', methods: ['GET'])]
    public function __invoke(Request $request, string $token): JsonResponse
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);

        $contract = $this->contractFinder->__invoke($token);
        $chart = $this->candlesObtainer->__invoke($contract['address'], $timeframe, $page);

        return new JsonResponse($chart);
    }
}

<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinCandlesLister;
use Ocebot\KujiraTrack\Fin\Application\FinContractFinder;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinContractCandles extends AbstractController
{
    public function __construct(
        private readonly FinContractFinder $contractFinder,
        private readonly FinCandlesLister $candlesObtainer
    ) {
    }

    #[Route('/fin/contracts/{tickerId}/candles', name: 'fin_contract_candles', methods: ['GET'])]
    #[OA\Tag(name: 'FIN')]
    public function __invoke(Request $request, string $identifier): JsonResponse
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);

        $contract = $this->contractFinder->__invoke($identifier);
        $chart = $this->candlesObtainer->__invoke($contract['address'], $timeframe, $page);

        return new JsonResponse($chart);
    }
}

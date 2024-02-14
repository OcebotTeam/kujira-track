<?php

namespace App\Controller\FinContractCharts;

use Ocebot\KujiraTrack\FinContractCharts\Application\FinContractChartRequester;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetFinContractChart extends AbstractController
{
    public function __construct(
        private readonly FinContractChartRequester $chartRequest,
        private readonly FinContractFinder $contractFinder
    ) {
    }

    #[Route('/fin/contracts/{tickerId}/candles', name: 'fin_contract_candles', methods: ['GET'])]
    public function __invoke(Request $request, string $tickerId)
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);
        $contract = $this->contractFinder->__invoke($tickerId);
        $chart = $this->chartRequest->__invoke($contract['address'], $timeframe, $page);
        return new JsonResponse($chart);
    }
}
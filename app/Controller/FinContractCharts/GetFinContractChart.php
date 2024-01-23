<?php

namespace App\Controller\FinContractCharts;

use Ocebot\KujiraTrack\FinContractCharts\Application\FinContractChartRequester;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractFinder;

class GetFinContractChart extends AbstractController
{
    public function __construct(
        private readonly FinContractChartRequester $chartRequest,
        private readonly FinContractFinder $contractFinder
    ) {
    }

    #[Route('/fin/contracts/{tickerId}/chart')]
    public function __invoke(string $tickerId)
    {
        $contract = $this->contractFinder->__invoke($tickerId);
        $chart = $this->chartRequest->__invoke($contract['address'], 'day1', 'yesterday', 'now');
        return new JsonResponse($chart);
    }
}
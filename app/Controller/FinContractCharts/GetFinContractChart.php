<?php

namespace App\Controller\FinContractCharts;

use Ocebot\KujiraTrack\FinContractCharts\Application\FinContractChartRequester;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class GetFinContractChart extends AbstractController
{
    public function __construct(
        private readonly FinContractChartRequester $chartRequest,
        private readonly FinContractFinder $contractFinder,
        private readonly KernelInterface $kernel
    ) {
    }

    #[Route('/fin/contracts/{tickerId}/candles', name: 'fin_contract_candles', methods: ['GET'])]
    public function __invoke(Request $request, string $tickerId)
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);

        $contract = $this->contractFinder->__invoke($tickerId);
        $chart = $this->chartRequest->__invoke($contract['address'], $timeframe, $page);

        $response = new JsonResponse($chart);
        
        // Get the current environment
        $environment = $this->kernel->getEnvironment();

        // Set CORS headers only in 'dev' environment
        if ($environment === 'dev') {
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept');
        }

        return $response;
    }
}
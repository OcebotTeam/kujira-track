<?php

namespace App\Controller\FinContractCharts;

use Ocebot\KujiraTrack\FinContractCharts\Application\FinTotalVolumeCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinTotalVolume extends AbstractController
{
    public function __construct(private readonly FinTotalVolumeCalculator $calculator)
    {
    }

    #[Route('/fin/volume', name: 'fin_total_volume', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $timeframe = $request->query->get('timeframe');

        $totalVolume = $this->calculator->__invoke($timeframe, $from, $to);

        return new JsonResponse($totalVolume);
    }
}
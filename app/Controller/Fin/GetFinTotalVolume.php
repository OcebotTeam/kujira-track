<?php

namespace App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinTotalVolumeCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinTotalVolume extends AbstractController
{
    public function __construct(
        private readonly FinTotalVolumeCalculator $calculator
    ) {
    }

    #[Route('/fin/volume', name: 'fin_total_volume', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);

        $totalVolume = $this->calculator->__invoke($timeframe, $page);

        return new JsonResponse($totalVolume);
    }
}

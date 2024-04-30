<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinTotalUsdVolumeObtainer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinTotalUsdVolume extends AbstractController
{
    public function __construct(
        private readonly FinTotalUsdVolumeObtainer $calculator
    ) {
    }

    #[Route('/fin/usd-volume', name: 'fin_total_usd_volume', methods: ['GET'])]
    #[OA\Tag(name: 'FIN')]
    public function __invoke(Request $request): JsonResponse
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);

        $totalVolume = $this->calculator->__invoke($timeframe, $page);

        return new JsonResponse($totalVolume);
    }
}

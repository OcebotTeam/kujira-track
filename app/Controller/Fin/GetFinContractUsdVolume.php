<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinContractUsdVolumeObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinContractUsdVolume extends AbstractController
{
    public function __construct(
        private readonly FinContractUsdVolumeObtainer $usdVolumeObtainer
    ) {
    }

    #[Route('/fin/contracts/{tickerId}/usd-volume')]
    public function __invoke(Request $request, string $tickerId): JsonResponse
    {
        $timeframe = $request->query->get('timeframe', 'daily');
        $page = $request->query->get('page', 0);

        $usdVolume = $this->usdVolumeObtainer->__invoke($tickerId, $timeframe, $page);
        return new JsonResponse($usdVolume);
    }
}

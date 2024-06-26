<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\GhostAprCalculator;
use Ocebot\KujiraTrack\Fin\Application\GhostContractFinder;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetGhostApr extends AbstractController
{
    public function __construct(
        private readonly GhostContractFinder $finder,
        private readonly GhostAprCalculator $calculator
    ) {
    }

    #[Route('/ghost/contracts/{token}/apr', name: 'get_ghost_apr', methods: ['GET'])]
    #[OA\Tag(name: 'GHOST')]
    #[OA\Response(response: 200, description: 'Returns monthly increase percentage and APR')]
    #[OA\Response(response: 404, description: 'Contract not found')]
    public function __invoke(Request $request, $token): JsonResponse
    {
        $timeframe = $request->query->get('timeframe', 'monthly');
        $page = $request->query->get('page', 0);
        $finContract = $this->finder->__invoke($token);
        $contracts = $this->calculator->__invoke($finContract['address'], $timeframe, $page);
        return new JsonResponse($contracts);
    }
}

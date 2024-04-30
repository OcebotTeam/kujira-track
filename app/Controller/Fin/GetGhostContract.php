<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\GhostContractFinder;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetGhostContract extends AbstractController
{
    public function __construct(
        private readonly GhostContractFinder $finder
    ) {
    }

    #[Route('/ghost/contracts/{token}', name: 'get_ghost_contract', methods: ['GET'])]
    #[OA\Tag(name: 'GHOST')]
    #[OA\Response(response: 200, description: 'Returns Contract details for a token')]
    #[OA\Response(response: 404, description: 'Contract not found')]
    public function __invoke($token): JsonResponse
    {
        $contracts = $this->finder->__invoke($token);
        return new JsonResponse($contracts);
    }
}

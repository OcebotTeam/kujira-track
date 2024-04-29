<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\GhostContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetGhostContract extends AbstractController
{
    public function __construct(private readonly GhostContractFinder $finder)
    {
    }

    #[Route('/ghost/contracts/{token}')]
    public function __invoke($token): JsonResponse
    {
        $contracts = $this->finder->__invoke($token);
        return new JsonResponse($contracts);
    }
}

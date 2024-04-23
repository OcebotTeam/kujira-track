<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\GhostContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetGhostContract extends AbstractController
{
    public function __construct(private readonly GhostContractFinder $ghostContractFinder)
    {
    }

    #[Route('/ghost/contracts/{token}')]
    public function __invoke($token)
    {
        $contracts = $this->ghostContractFinder->__invoke($token);
        return new JsonResponse($contracts);
    }
}

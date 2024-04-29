<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\GhostContractLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetGhostContractList extends AbstractController
{
    public function __construct(private readonly GhostContractLister $lister)
    {
    }

    #[Route('/ghost/contracts')]
    public function __invoke(): JsonResponse
    {
        $contracts = $this->lister->__invoke();
        return new JsonResponse($contracts);
    }
}

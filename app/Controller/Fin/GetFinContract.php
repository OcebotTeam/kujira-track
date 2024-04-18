<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetFinContract extends AbstractController
{
    public function __construct(private readonly FinContractFinder $finder)
    {
    }

    #[Route('/fin/contracts/{tickerId}')]
    public function __invoke(string $tickerId)
    {
        $contract = $this->finder->__invoke($tickerId);
        return new JsonResponse($contract);
    }
}

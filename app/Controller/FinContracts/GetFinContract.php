<?php

namespace App\Controller\FinContracts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractFinder;

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
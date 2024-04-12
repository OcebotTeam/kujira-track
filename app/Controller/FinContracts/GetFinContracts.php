<?php

namespace App\Controller\FinContracts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractLister;

class GetFinContracts extends AbstractController
{
    public function __construct(private readonly FinContractLister $contractsObtainer)
    {
    }

    #[Route('/fin/contracts')]
    public function __invoke()
    {
        $contracts = $this->contractsObtainer->__invoke();
        return new JsonResponse($contracts);
    }
}

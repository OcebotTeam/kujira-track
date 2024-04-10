<?php

namespace App\Controller\UskCollaterals;

use Ocebot\KujiraTrack\UskCollaterals\Application\UskCollateralLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractLister;

class GetUskCollaterals extends AbstractController
{
    public function __construct(private readonly UskCollateralLister $uskCollateralObtainer)
    {
    }

    #[Route('/usk/collaterals')]
    public function __invoke()
    {
        $contracts = $this->uskCollateralObtainer->__invoke();
        return new JsonResponse($contracts);
    }
}
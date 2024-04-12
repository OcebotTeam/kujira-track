<?php

namespace App\Controller\UskCollaterals;

use Ocebot\KujiraTrack\UskCollaterals\Application\UskCollateralFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUskCollateral extends AbstractController
{
    public function __construct(private readonly UskCollateralFinder $uskCollateralFinder)
    {
    }

    #[Route('/usk/collaterals/{token}')]
    public function __invoke(string $token)
    {
        $contracts = $this->uskCollateralFinder->__invoke($token);
        return new JsonResponse($contracts);
    }
}

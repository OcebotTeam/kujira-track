<?php

namespace App\Controller\UskMint;

use Ocebot\KujiraTrack\UskMint\Application\UskMintObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUskMintedCollateral extends AbstractController
{
    public function __construct(private readonly UskMintObtainer $uskMintObtainer)
    {
    }

    #[Route('/usk/mint/{collateral}')]
    public function __invoke($collateral)
    {
        $UskMinted = $this->uskMintObtainer->__invoke($collateral);
        return new JsonResponse($UskMinted);
    }
}

<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintEvolutionObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintEvolution extends AbstractController
{
    public function __construct(private readonly MintEvolutionObtainer $obtainer)
    {
    }

    #[Route('/mint/{collateral}/evolution')]
    public function __invoke($collateral)
    {
        $UskMinted = $this->obtainer->__invoke($collateral);
        return new JsonResponse($UskMinted);
    }
}

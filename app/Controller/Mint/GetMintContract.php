<?php

namespace App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintContractFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintContract extends AbstractController
{
    public function __construct(private readonly MintContractFinder $finder)
    {
    }

    #[Route('/mint/{collateral}')]
    public function __invoke(string $collateral)
    {
        $mintContract = $this->finder->__invoke($collateral);
        return new JsonResponse($mintContract);
    }
}

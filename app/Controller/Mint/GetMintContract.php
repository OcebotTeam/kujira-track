<?php

namespace App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintContractFinder;
use Ocebot\KujiraTrack\Mint\Application\MintCurrentValueRequester;
use Ocebot\KujiraTrack\Mint\Domain\MintValueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintContract extends AbstractController
{
    public function __construct(
        private readonly MintContractFinder $finder,
        private readonly MintCurrentValueRequester $valueRequester
    ) {
    }

    #[Route('/mint/{collateral}')]
    public function __invoke(string $collateral)
    {
        $mintContract = $this->finder->__invoke($collateral);
        $currentValue = $this->valueRequester->__invoke($mintContract['address']);
        $mintContract['value'] = $currentValue['value'];

        return new JsonResponse($mintContract);
    }
}

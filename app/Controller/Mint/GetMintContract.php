<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintContractFinder;
use Ocebot\KujiraTrack\Mint\Application\MintCurrentValueRequester;
use OpenApi\Attributes as OA;
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

    #[Route('/mint/{collateral}', name: 'get_mint_contract', methods: ['GET'])]
    #[OA\Tag(name: 'USK')]
    #[OA\Response(response: 200, description: 'Return contracts details for a collateral')]
    #[OA\Response(response: 404, description: 'Collateral not found')]
    public function __invoke(string $collateral) : JsonResponse
    {
        $mintContract = $this->finder->__invoke($collateral);
        $currentValue = $this->valueRequester->__invoke($mintContract['address']);
        $mintContract['value'] = $currentValue['value'];
        return new JsonResponse($mintContract);
    }
}

<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintEvolutionAggregatorDiff;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintDiff extends AbstractController
{
    public function __construct(private readonly MintEvolutionAggregatorDiff $aggregator)
    {
    }

    #[Route('/mint/aggregation/diff', name: 'get_mint_diff', methods: ['GET'])]
    #[OA\Tag(name: 'USK')]
    #[OA\Response(response: 200, description: 'Return increments/decrements of minted USK')]
    public function __invoke(): JsonResponse
    {
        $UskMinted = $this->aggregator->__invoke();
        return new JsonResponse($UskMinted);
    }
}

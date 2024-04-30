<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintEvolutionAggregator;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintAggregation extends AbstractController
{
    public function __construct(private readonly MintEvolutionAggregator $aggregator)
    {
    }

    #[Route('/mint/aggregation', name: 'get_mint_aggregation', methods: ['GET'])]
    #[OA\Tag(name: 'USK')]
    #[OA\Response(response: 200, description: 'Return evolution of minted USK aggregated')]
    public function __invoke(): JsonResponse
    {
        $UskMinted = $this->aggregator->__invoke();
        return new JsonResponse($UskMinted);
    }
}

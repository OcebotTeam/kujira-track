<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintEvolutionObtainer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintEvolution extends AbstractController
{
    public function __construct(private readonly MintEvolutionObtainer $obtainer)
    {
    }

    #[Route('/mint/{collateral}/evolution', name: 'get_mint_evolution', methods: ['GET'])]
    #[OA\Tag(name: 'USK')]
    #[OA\Response(response: 200, description: 'Return evolution of minted USK by collateral')]
    #[OA\Response(response: 404, description: 'Collateral not found')]
    public function __invoke($collateral): JsonResponse
    {
        $UskMinted = $this->obtainer->__invoke($collateral);
        return new JsonResponse($UskMinted);
    }
}

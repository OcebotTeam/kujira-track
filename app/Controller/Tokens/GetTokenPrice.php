<?php

namespace Ocebot\KujiraTrack\App\Controller\Tokens;

use Ocebot\KujiraTrack\Tokens\Application\TokenPricer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetTokenPrice extends AbstractController
{
    public function __construct(
        private readonly TokenPricer $tokenPricer
    ) {
    }

    #[Route('/tokens/{symbol}/price', name: 'get_token_price', methods: ['GET'])]
    #[OA\Tag(name: 'TOKENS')]
    #[OA\Response(response: 200, description: 'Return Token price')]
    public function __invoke(string $symbol): JsonResponse
    {
        $price = $this->tokenPricer->__invoke($symbol);
        return new JsonResponse($price);
    }
}

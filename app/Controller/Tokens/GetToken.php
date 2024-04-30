<?php

namespace Ocebot\KujiraTrack\App\Controller\Tokens;

use Ocebot\KujiraTrack\Tokens\Application\TokenFinder;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetToken extends AbstractController
{
    public function __construct(
        private readonly TokenFinder $tokenFinder,
    ) {
    }

    #[Route('/tokens/{symbol}', name: 'get_token', methods: ['GET'])]
    #[OA\Tag(name: 'TOKENS')]
    #[OA\Response(response: 200, description: 'Return Token information')]
    public function __invoke(string $symbol): JsonResponse
    {
        $token = $this->tokenFinder->__invoke($symbol);
        return new JsonResponse($token);
    }
}

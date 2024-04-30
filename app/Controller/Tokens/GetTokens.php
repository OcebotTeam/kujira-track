<?php

namespace Ocebot\KujiraTrack\App\Controller\Tokens;

use Ocebot\KujiraTrack\Tokens\Application\TokenLister;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetTokens extends AbstractController
{
    public function __construct(private readonly TokenLister $tokenLister)
    {
    }

    #[Route('/tokens', name: 'get_tokens', methods: ['GET'])]
    #[OA\Tag(name: 'TOKENS')]
    #[OA\Response(response: 200, description: 'Return Tokens list')]
    public function __invoke(): JsonResponse
    {
        $tokens = $this->tokenLister->__invoke();
        return new JsonResponse($tokens);
    }
}

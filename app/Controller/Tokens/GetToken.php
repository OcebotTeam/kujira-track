<?php

namespace App\Controller\Tokens;

use Ocebot\KujiraTrack\Tokens\Application\TokenFinder;
use Ocebot\KujiraTrack\Tokens\Application\TokenPricer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetToken extends AbstractController
{
    public function __construct(
        private readonly TokenFinder $tokenFinder,
        private readonly TokenPricer $tokenPricer
    )
    {
    }

    #[Route('/tokens/{symbol}')]
    public function __invoke(string $symbol)
    {
        $token = $this->tokenFinder->__invoke($symbol);
        $token['price'] = $this->tokenPricer->__invoke($symbol);
        return new JsonResponse($token);
    }
}

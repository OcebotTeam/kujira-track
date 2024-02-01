<?php

namespace App\Controller\Tokens;

use Ocebot\KujiraTrack\Tokens\Application\TokenLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetTokens extends AbstractController
{
    public function __construct(private readonly TokenLister $tokenLister)
    {
    }

    #[Route('/tokens')]
    public function __invoke()
    {
        $tokens = $this->tokenLister->__invoke();
        return new JsonResponse($tokens);
    }
}
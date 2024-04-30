<?php

namespace Ocebot\KujiraTrack\App\Controller\Wallets;

use Ocebot\KujiraTrack\Wallets\Application\WalletsDiffObtainer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetWalletsDiff extends AbstractController
{
    public function __construct(
        private readonly WalletsDiffObtainer $obtainer
    ) {
    }

    #[Route('/v2/wallets/diff', name: 'get_wallets_diff', methods: ['GET'])]
    #[OA\Tag(name: 'WALLETS')]
    #[OA\Response(response: 200, description: 'Return increment/Decrement Wallets')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->obtainer->__invoke());
    }
}

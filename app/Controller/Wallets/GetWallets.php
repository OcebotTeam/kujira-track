<?php

namespace Ocebot\KujiraTrack\App\Controller\Wallets;

use Ocebot\KujiraTrack\Wallets\Application\WalletsObtainer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetWallets extends AbstractController
{
    public function __construct(
        private readonly WalletsObtainer $walletsObtainer
    ) {
    }

    #[Route('/v2/wallets', name: 'get_wallets', methods: ['GET'])]
    #[OA\Tag(name: 'WALLETS')]
    #[OA\Response(response: 200, description: 'Return Wallets')]
    public function __invoke(): JsonResponse
    {
        $stakedKuji = $this->walletsObtainer->__invoke();
        return new JsonResponse($stakedKuji);
    }
}

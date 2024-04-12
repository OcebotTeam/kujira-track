<?php

namespace App\Controller\Wallets;

use Ocebot\KujiraTrack\Wallets\Application\WalletsObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetWallets extends AbstractController
{
    public function __construct(
        private readonly WalletsObtainer $walletsObtainer
    ) {
    }

    #[Route('/v2/wallets')]
    public function __invoke()
    {
        $stakedKuji = $this->walletsObtainer->__invoke();
        return new JsonResponse($stakedKuji);
    }
}

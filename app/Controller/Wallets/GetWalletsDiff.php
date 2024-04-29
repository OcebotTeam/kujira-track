<?php

namespace Ocebot\KujiraTrack\App\Controller\Wallets;

use Ocebot\KujiraTrack\Wallets\Application\WalletsDiffObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetWalletsDiff extends AbstractController
{
    public function __construct(
        private readonly WalletsDiffObtainer $obtainer
    ) {
    }

    #[Route('/v2/wallets/diff')]
    public function __invoke()
    {
        return new JsonResponse($this->obtainer->__invoke());
    }
}

<?php

namespace App\Controller\Staking;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetStaking extends AbstractController
{
    public function __construct(
        private readonly StakedKujiObtainer $stakedKujiObtainer
    ) {
    }

    #[Route('/staking')]
    public function __invoke()
    {
        $stakedKuji = $this->stakedKujiObtainer->__invoke();
        return new JsonResponse($stakedKuji);
    }
}

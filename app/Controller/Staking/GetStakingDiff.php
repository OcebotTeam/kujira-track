<?php

namespace App\Controller\Staking;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiDiffObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetStakingDiff extends AbstractController
{
    public function __construct(
        private readonly StakedKujiDiffObtainer $obtainer
    ) {
    }

    #[Route('/staking/diff')]
    public function __invoke()
    {
        return new JsonResponse($this->obtainer->__invoke());
    }
}

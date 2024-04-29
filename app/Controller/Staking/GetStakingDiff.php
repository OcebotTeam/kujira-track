<?php

namespace Ocebot\KujiraTrack\App\Controller\Staking;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiDiffObtainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

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

<?php

namespace Ocebot\KujiraTrack\App\Controller\Staking;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiDiffObtainer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetStakingDiff extends AbstractController
{
    public function __construct(
        private readonly StakedKujiDiffObtainer $obtainer
    ) {
    }

    #[Route('/staking/diff', name: 'get_staking_diff', methods: ['GET'])]
    #[OA\Tag(name: 'STAKE')]
    #[OA\Response(response: 200, description: 'Return increments/decrements of KUJI staked')]
    public function __invoke() : JsonResponse
    {
        return new JsonResponse($this->obtainer->__invoke());
    }
}

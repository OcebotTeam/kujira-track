<?php

namespace Ocebot\KujiraTrack\App\Controller\Staking;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiObtainer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetStaking extends AbstractController
{
    public function __construct(
        private readonly StakedKujiObtainer $stakedKujiObtainer
    ) {
    }

    #[Route('/staking', name: 'get_staking', methods: ['GET'])]
    #[OA\Tag(name: 'STAKE')]
    #[OA\Response(response: 200, description: 'Return evolution of KUJI staked')]
    public function __invoke() : JsonResponse
    {
        $stakedKuji = $this->stakedKujiObtainer->__invoke();
        return new JsonResponse($stakedKuji);
    }
}

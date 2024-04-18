<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintEvolutionAggregatorDiff;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintDiff extends AbstractController
{
    public function __construct(private readonly MintEvolutionAggregatorDiff $aggregator)
    {
    }

    #[Route('/mint/aggregation/diff')]
    public function __invoke()
    {
        $UskMinted = $this->aggregator->__invoke();
        return new JsonResponse($UskMinted);
    }
}

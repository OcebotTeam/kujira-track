<?php

namespace App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintEvolutionAggregator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintAggregation extends AbstractController
{
    public function __construct(private readonly MintEvolutionAggregator $aggregator)
    {
    }

    #[Route('/mint/aggregation')]
    public function __invoke()
    {
        $UskMinted = $this->aggregator->__invoke();
        return new JsonResponse($UskMinted);
    }
}

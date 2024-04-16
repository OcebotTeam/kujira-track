<?php

namespace App\Controller\UskMint;

use Ocebot\KujiraTrack\UskMint\Application\UskMintAggregator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUskMinted extends AbstractController
{
    public function __construct(private readonly UskMintAggregator $aggregator)
    {
    }

    #[Route('/usk/mint')]
    public function __invoke()
    {
        $UskMinted = $this->aggregator->__invoke();
        return new JsonResponse($UskMinted);
    }
}

<?php

namespace App\Controller\FinContractCharts;

use Ocebot\KujiraTrack\FinContractCharts\Application\TimeframeLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetTimeframes extends AbstractController
{
    public function __construct(private readonly TimeframeLister $lister)
    {
    }

    #[Route('/fin/timeframes')]
    public function __invoke()
    {
        $timeframes = $this->lister->__invoke();
        return new JsonResponse($timeframes);
    }
}
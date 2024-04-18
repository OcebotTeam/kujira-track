<?php

namespace App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\TimeframeLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

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

<?php

namespace App\Controller\FinCandles;

use Ocebot\KujiraTrack\FinCandles\Application\FinTotalFeesCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinTotalFees extends AbstractController
{
    public function __construct(private readonly FinTotalFeesCalculator $calculator)
    {
    }

    #[Route('/fin/fees', name: 'fin_total_fees', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $totalVolume = $this->calculator->__invoke($from, $to);
        return new JsonResponse($totalVolume);
    }
}
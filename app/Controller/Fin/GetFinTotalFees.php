<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinTotalFeesCalculator;
use OpenApi\Attributes as OA;
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
    #[OA\Tag(name: 'FIN')]
    public function __invoke(Request $request): JsonResponse
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $totalVolume = $this->calculator->__invoke($from, $to);
        return new JsonResponse($totalVolume);
    }
}

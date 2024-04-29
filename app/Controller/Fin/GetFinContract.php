<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinContractFinder;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetFinContract extends AbstractController
{
    public function __construct(private readonly FinContractFinder $finder)
    {
    }

    /**
     * Lists all FIN contracts
     */
    #[Route('/fin/contracts/{tickerId}', name: 'fin_contract', methods: ['GET'])]
    #[OA\Tag(name: 'FIN')]
    #[OA\Response(response: 200, description: 'Returns the contract for the given ticker id',)]
    #[OA\Response(response: 404, description: 'Contract not found')]
    public function __invoke(string $tickerId): JsonResponse
    {
        $contract = $this->finder->__invoke($tickerId);
        return new JsonResponse($contract);
    }
}

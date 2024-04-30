<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintContractLister;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintContractList extends AbstractController
{
    public function __construct(private readonly MintContractLister $uskCollateralObtainer)
    {
    }

    #[Route('/mint', name: 'get_mint_contract_list', methods: ['GET'])]
    #[OA\Tag(name: 'USK')]
    #[OA\Response(response: 200, description: 'Return contracts list')]
    public function __invoke(): JsonResponse
    {
        $contracts = $this->uskCollateralObtainer->__invoke();
        return new JsonResponse($contracts);
    }
}

<?php

namespace Ocebot\KujiraTrack\App\Controller\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintContractLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMintContractList extends AbstractController
{
    public function __construct(private readonly MintContractLister $uskCollateralObtainer)
    {
    }

    #[Route('/mint')]
    public function __invoke()
    {
        $contracts = $this->uskCollateralObtainer->__invoke();
        return new JsonResponse($contracts);
    }
}

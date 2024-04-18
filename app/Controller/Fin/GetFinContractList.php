<?php

namespace Ocebot\KujiraTrack\App\Controller\Fin;

use Ocebot\KujiraTrack\Fin\Application\FinContractLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetFinContractList extends AbstractController
{
    public function __construct(private readonly FinContractLister $contractsObtainer)
    {
    }

    #[Route('/fin/contracts')]
    public function __invoke()
    {
        $contracts = $this->contractsObtainer->__invoke();
        return new JsonResponse($contracts);
    }
}

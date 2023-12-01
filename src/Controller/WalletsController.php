<?php

namespace App\Controller;

use App\Entity\Wallets;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classes\Helpers;

class WalletsController extends AbstractController {

    #[Route('/wallets')]
    public function wallets(EntityManagerInterface $entityManager)
    {
        $helper = new Helpers();
        $wallets = $helper->getEntityPerDay($entityManager, Wallets::class);

        // Format key/values to meet the front needs.
        $formatted_wallets = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $wallets);

        // Return response
        return new Response(
            json_encode(["wallets" => array_values($formatted_wallets)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

}
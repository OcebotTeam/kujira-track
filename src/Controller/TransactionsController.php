<?php

namespace App\Controller;

use App\Entity\Transactions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classes\Helpers;

class TransactionsController extends AbstractController {

    #[Route('/transactions')]
    public function transactions(EntityManagerInterface $entityManager)
    {
        $helper = new Helpers();
        $transactions = $helper->getEntityPerDay($entityManager, Transactions::class);

        // Format key/values to meet the front needs.
        $filtered_transactions = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $transactions);

        // Return response
        return new Response(
            json_encode(["transactions" => array_values($filtered_transactions)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }


}
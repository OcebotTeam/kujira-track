<?php

namespace App\Controller;

use App\Entity\StakedTokens;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classes\Helpers;

class StakedTokensController extends AbstractController
{
    #[Route('/stakedtokens')]
    public function stakedTokens(EntityManagerInterface $entityManager)
    {
        $helper = new Helpers();
        $staked_tokens = $helper->getEntityPerDay($entityManager, StakedTokens::class);

        // Format key/values to meet the front needs.
        $filtered_staked_tokens = array_map(function ($item) {
            return [
                "value" => $item->getBondedTokens(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $staked_tokens);

        // Return response
        return new Response(
            json_encode(["stakedtokens" => array_values($filtered_staked_tokens)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

}

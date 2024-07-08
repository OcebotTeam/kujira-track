<?php

namespace Ocebot\KujiraTrack\App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Classes\Helpers;
use Ocebot\KujiraTrack\App\Entity\UskMinted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UskMintedController extends AbstractController
{
    #[Route('/uskminted')]
    public function uskMinted(EntityManagerInterface $entityManager)
    {
        $helper = new Helpers();
        $usk_minted = $helper->getEntityPerDay($entityManager, UskMinted::class);

        // Format key/values to meet the front needs.
        $filtered_usk_minted = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $usk_minted);

        // Return response
        return new Response(
            json_encode(["uskminted" => array_values($filtered_usk_minted)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    #[Route('v2/uskminted')]
    public function uskMintedv2(EntityManagerInterface $entityManager)
    {

        $usk_minted_repo = $entityManager->getRepository(UskMinted::class);
        $usk_minted_all = $usk_minted_repo->findBy([], ["tracked" => "ASC"],null,30000);
        $result = [];

        foreach($usk_minted_all as $item) {
            $date = $item->getTracked()->format('Y-m-d');
            $collateral = $item->getCollateral();
            $result[$collateral][$date] = [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }

        foreach ($result as &$collateral) {
            $collateral = array_values($collateral);
        }

        // Return response
        return new Response(
            json_encode(["uskminted" => $result]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

}

<?php

namespace Ocebot\KujiraTrack\App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Classes\Helpers;
use Ocebot\KujiraTrack\App\Entity\StakedManta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MantaStakedController extends AbstractController
{
    #[Route('/mantastaked')]
    public function mantaStaked(EntityManagerInterface $entityManager)
    {
        $helper = new Helpers();
        $manta_staked = $helper->getEntityPerDay($entityManager, StakedManta::class);

        // Format key/values to meet the front needs.
        $filtered_manta_staked = array_map(function ($item) {
            return [
                "value" => $item->getBonded(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $manta_staked);

        // Return response
        return new Response(
            json_encode(["mantastaked" => array_values($filtered_manta_staked)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

}

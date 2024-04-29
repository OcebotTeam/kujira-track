<?php

namespace Ocebot\KujiraTrack\App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Classes\Helpers;
use Ocebot\KujiraTrack\App\Entity\Unmigrated;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnmigratedController extends AbstractController
{
    #[Route('/unmigrated')]
    public function unmigrated(EntityManagerInterface $entityManager)
    {
        $helper = new Helpers();
        $unmigrated_tokens = $helper->getEntityPerDay($entityManager, Unmigrated::class);

        // Format key/values to meet the front needs.
        $filtered_unmigrated_tokens = array_map(function ($item) {
            return [
                "value" => $item->getNum(),
                "time" => $item->getTracked()->format('Y-m-d')
            ];
        }, $unmigrated_tokens);

        // Return response
        return new Response(
            json_encode(["unmigrated" => array_values($filtered_unmigrated_tokens)]),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }
}

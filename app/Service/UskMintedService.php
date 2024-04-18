<?php

namespace Ocebot\KujiraTrack\App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Entity\UskMinted;
use Symfony\Component\HttpClient\HttpClient;

class UskMintedService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setUskMinted(EntityManagerInterface $doctrine): void
    {

        $endpoints = $this->application_globals->get_uskminted_endpoints();

        foreach ($endpoints as $token => $endpoint) {
            $client = HttpClient::create();
            $response = $client->request(
                'GET',
                $endpoint
            );
            $stored = new \DateTime("now");
            $collateral = $token;
            $Usk_minted_json = json_decode($response->getContent());
            $Usk_minted = new UskMinted();
            $Usk_minted->setNum($Usk_minted_json->data->debt_amount);
            $Usk_minted->setCollateral($collateral);
            $Usk_minted->setTracked($stored);
            $doctrine->persist($Usk_minted);
            $doctrine->flush();
        }

    }

}

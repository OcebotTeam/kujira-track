<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\GhostDeposit;

class GhostDepositService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setGhostDeposit(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['ghostKUJIUSK']
        );
        $stored = new \DateTime("now");
        $collateral = 'KUJI';
        $ghost_deposited_json = json_decode($response->getContent());
        $ghost_deposited = new GhostDeposit();
        $ghost_deposited->setNum($ghost_deposited_json->data->deposited);
        $ghost_deposited->setCollateral($collateral);
        $ghost_deposited->setTracked($stored);
        $doctrine->persist($ghost_deposited);
        $doctrine->flush();


        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['ghostUSKKUJI']
        );
        $stored = new \DateTime("now");
        $collateral = 'USK';
        $ghost_deposited_json = json_decode($response->getContent());
        $ghost_deposited = new GhostDeposit();
        $ghost_deposited->setNum($ghost_deposited_json->data->deposited);
        $ghost_deposited->setCollateral($collateral);
        $ghost_deposited->setTracked($stored);
        $doctrine->persist($ghost_deposited);
        $doctrine->flush();

    }

}

<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\LockedManta;


class LockedMantaService
{

    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setLockedTokens(EntityManagerInterface $doctrine): void
    {
        $api_urls = $this->application_globals->get_api_urls();
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['Mantalocked']
        );
        $tracked = new \DateTime("now");
        $tokens = json_decode($response->getContent());
        $staked_tokens = new LockedManta();
        $staked_tokens->setLocked(floor($tokens->balances[0]->amount/1000000));
        $staked_tokens->setTracked($tracked);
        $doctrine->persist($staked_tokens);
        $doctrine->flush();
    }
}
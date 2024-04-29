<?php

namespace Ocebot\KujiraTrack\App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Entity\StakedManta;
use Symfony\Component\HttpClient\HttpClient;

class StakedMantaService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setStakedTokens(EntityManagerInterface $doctrine): void
    {
        $api_urls = $this->application_globals->get_api_urls();
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['MantaStaked']
        );
        $tracked = new \DateTime("now");
        $tokens = json_decode($response->getContent());
        $staked_tokens = new StakedManta();
        $staked_tokens->setBonded($tokens->data->weight);
        $staked_tokens->setTracked($tracked);
        $doctrine->persist($staked_tokens);
        $doctrine->flush();
    }
}

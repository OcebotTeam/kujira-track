<?php

namespace Ocebot\KujiraTrack\App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Entity\StakedTokens;
use Symfony\Component\HttpClient\HttpClient;

class StakedTokensService
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
            $api_urls['staked_tokens']
        );
        $tracked = new \DateTime("now");
        $pool_json = json_decode($response->getContent());
        $staked_tokens = new StakedTokens();
        $staked_tokens->setBondedTokens($pool_json->pool->bonded_tokens);
        $staked_tokens->setNotBondedTokens($pool_json->pool->not_bonded_tokens);
        $staked_tokens->setTracked($tracked);
        $doctrine->persist($staked_tokens);
        $doctrine->flush();
    }
}

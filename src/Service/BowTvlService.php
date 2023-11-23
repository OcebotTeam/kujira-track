<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\BowTvl;

class BowTvlService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setBowTvlService(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $bow_contracts = $this->application_globals->get_bow_contracts();
        $query_string = 'eyJwb29sIjp7fX0=';

        foreach ($bow_contracts as $key => $value) {

            $endpoint = $api_urls['contracts'] . $value . '/smart/' . $query_string;
            $client = HttpClient::create();
            $response = $client->request(
                'GET',
                $endpoint
            );
            $stored = new \DateTime("now");

            $balance = json_decode($response->getContent());
            $bowTvl_first_token = new BowTvl();
            $bowTvl_second_token = new BowTvl();
            $bowTvl_first_token->setPair($key);
            $bowTvl_second_token->setPair($key);

            $tokens = explode('/', $key);
            $bowTvl_first_token->setToken($tokens[0]);
            $bowTvl_second_token->setToken($tokens[1]);

            $bowTvl_first_token->setBalance($balance->data->balances[0]);
            $bowTvl_second_token->setBalance($balance->data->balances[1]);
            $bowTvl_first_token->setTracked($stored);
            $bowTvl_second_token->setTracked($stored);

            $doctrine->persist($bowTvl_first_token);
            $doctrine->persist($bowTvl_second_token);
            $doctrine->flush();

        }
    }






}

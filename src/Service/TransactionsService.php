<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Transactions;

class TransactionsService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setTransactions(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $token_list = $this->application_globals->get_tokens();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['transactions']
        );
        $stored = new \DateTime("now");

        $transactions_json = json_decode($response->getContent());
        $transactions = new Transactions();
        $transactions->setNum($transactions_json->count);
        $transactions->setTracked($stored);
        $doctrine->persist($transactions);
        $doctrine->flush();






    }


}

<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Wallets;

class WalletsService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setWallets(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $token_list = $this->application_globals->get_tokens();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['wallets']
        );
        $stored = new \DateTime("now");

        $wallets_json = json_decode($response->getContent());
        $wallets = new Wallets();
        $wallets->setNum($wallets_json->pagination->total);
        $wallets->setTracked($stored);
        $doctrine->persist($wallets);
        $doctrine->flush();

    }

}

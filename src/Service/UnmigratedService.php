<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Unmigrated;

class UnmigratedService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setUnmigrated(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $token_list = $this->application_globals->get_tokens();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['unmigrated']
        );
        $stored = new \DateTime("now");

        $wallets_json = json_decode($response->getContent());
        $unmigrated = new Unmigrated();
        $unmigrated->setNum((int) $wallets_json->unmigrated/1000000);
        $unmigrated->setTracked($stored);
        $doctrine->persist($unmigrated);
        $doctrine->flush();

    }

}

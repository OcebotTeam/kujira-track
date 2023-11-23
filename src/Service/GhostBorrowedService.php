<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\GhostBorrowed;

class GhostBorrowedService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setGhostBorrowed(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['ghostKUJIUSK']
        );
        $stored = new \DateTime("now");
        $collateral = 'USK';
        $ghost_borrowed_json = json_decode($response->getContent());
        $ghost_borrowed = new GhostBorrowed();
        $ghost_borrowed->setNum($ghost_borrowed_json->data->borrowed);
        $ghost_borrowed->setCollateral($collateral);
        $ghost_borrowed->setTracked($stored);
        $doctrine->persist($ghost_borrowed);
        $doctrine->flush();


        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['ghostUSKKUJI']
        );
        $stored = new \DateTime("now");
        $collateral = 'KUJI';
        $ghost_borrowed_json = json_decode($response->getContent());
        $ghost_borrowed = new GhostBorrowed();
        $ghost_borrowed->setNum($ghost_borrowed_json->data->borrowed);
        $ghost_borrowed->setCollateral($collateral);
        $ghost_borrowed->setTracked($stored);
        $doctrine->persist($ghost_borrowed);
        $doctrine->flush();

    }

}

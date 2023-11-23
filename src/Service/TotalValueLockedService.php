<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\TotalValueLocked;

class TotalValueLockedService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setTotalValueLocked(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $fin_contracts = $this->application_globals->get_fin_contracts();
        $pairs = array_keys($fin_contracts);

        foreach ($pairs as $pair) {
            $client = HttpClient::create();
            $response = $client->request(
                'GET',
                $api_urls['total_value_locked'].$fin_contracts[$pair]
            );

            $stored = new \DateTime("now");

            $tvl_json = json_decode($response->getContent());

            foreach ($tvl_json->balances as $balance){
                $totalValueLocked = new TotalValueLocked();
                $totalValueLocked->setPair($pair);
                $totalValueLocked->setDenom($balance->denom);
                $totalValueLocked->setAmount($balance->amount);
                $totalValueLocked->setTracked($stored);
                $totalValueLocked->setTracked($stored);
                $doctrine->persist($totalValueLocked);
                $doctrine->flush();
            }

        }

    }
}

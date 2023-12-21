<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\BwVaults;

class BwVaultsService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setBwVaultsService(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $token_list = $this->application_globals->get_tokens();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['bw_vault'],
            [
                'headers' =>    [
                    'origin' => 'https://blue.kujira.app',
                    'referer' => 'https://blue.kujira.app',
                    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36'
                ]
            ]
        );
        $stored = new \DateTime("now");

        $bw_vault_json = json_decode($response->getContent());

        foreach ($bw_vault_json as $vault) {

            $bw_vault = new BwVaults();
            $bw_vault->setPair($vault->pair);
            $bw_vault->setVaultAddress($vault->vault_address);
            $bw_vault->setPerformance($vault->performance);
            $bw_vault->setProfitInUsdc($vault->profit_in_usdc);
            $bw_vault->setLiquidity($vault->liquidity);
            $bw_vault->setBaseDenom($vault->base_denom);
            $bw_vault->setQuoteDenom($vault->quote_denom);
            $bw_vault->setTracked($stored);
            $doctrine->persist($bw_vault);
            $doctrine->flush();

        }




    }


}

<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Token;

class StoredTokenService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setStoredTokens(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['tickers']
        );
        $stored = new \DateTime("now");

        $tokens_json = json_decode($response->getContent());
        foreach ($tokens_json as $tokens) {
            $numtokens = count($tokens);
            for ($i = 0; $i < $numtokens; $i++) {
                $token = new Token();
                $token->setBaseCurrency($tokens[$i]->base_currency);
                $token->setTargetCurrency($tokens[$i]->target_currency);
                $token->setTickerId($tokens[$i]->ticker_id);
                $token->setAsk(floatval($tokens[$i]->ask));
                $token->setBid(floatval($tokens[$i]->bid));
                $token->setHigh(floatval($tokens[$i]->high));
                $token->setLow(floatval($tokens[$i]->low));
                $token->setBaseVolume(floatval($tokens[$i]->base_volume));
                $token->setTargetVolume(floatval($tokens[$i]->target_volume));
                $token->setLastPrice(floatval($tokens[$i]->last_price));
                $token->setPoolId($tokens[$i]->pool_id);
                $token->setTracked($stored);
                $doctrine->persist($token);
                $doctrine->flush();
            }
        }
    }


}

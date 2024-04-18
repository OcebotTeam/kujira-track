<?php

namespace Ocebot\KujiraTrack\App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Entity\Liquidations;
use Ocebot\KujiraTrack\App\Repository\LiquidationsRepository;
use Symfony\Component\HttpClient\HttpClient;

class LiquidationsService
{
    private $entityManager;
    private $application_globals;
    private $liquidationsRepository;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals, LiquidationsRepository $liquidationsRepository)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
        $this->liquidationsRepository = $liquidationsRepository;
    }

    public function setLiquidations(EntityManagerInterface $doctrine, LiquidationsRepository $liquidationsRepository): void
    {

        $endpoints = $this->application_globals->get_api_urls();
        $endpoint = $endpoints['base_url'].$endpoints['liquidations'];


        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $endpoint
        );
        $liquidations = $response->getContent();
        $liquidations_array = json_decode($liquidations);
        $liquidations_iterative = $liquidations_array->liquidations;

        foreach ($liquidations_iterative as $item) {


            $liquidation = new Liquidations();

            if(empty($liquidationsRepository->findByLiquidationID($item->id))) {
                $liquidation->setLiquidationId($item->id);
                $liquidation->setTimestamp(strtotime($item->timestamp));
                $liquidation->setBurnAmount($item->burn_amount);
                $liquidation->setContractAddress($item->contract_address);
                $liquidation->setLiquidateAmount($item->liquidate_amount);
                $liquidation->setRefundAmount($item->refund_amount);
                $liquidation->setFeeAmount($item->fee_amount);


                $doctrine->persist($liquidation);
                $doctrine->flush();
            }
        }

    }

}

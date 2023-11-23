<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\CommunityPool;

class CommunityPoolService
{
    private $entityManager;
    private $application_globals;

    public function __construct(EntityManagerInterface $entityManager, ApplicationGlobalsService $application_globals)
    {

        $this->entityManager = $entityManager;
        $this->application_globals = $application_globals;
    }

    public function setCommunityPoolInfo(EntityManagerInterface $doctrine): void
    {

        $api_urls = $this->application_globals->get_api_urls();
        $token_list = $this->application_globals->get_tokens();

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            $api_urls['community_pool']
        );
        $stored = new \DateTime("now");

        $community_pool_json = json_decode($response->getContent());

        foreach ($community_pool_json as $pool){
            $tokens = count($pool);
            for($i = 0; $i < $tokens ; $i++){
                $community_pool = new CommunityPool();
                $community_pool->setDenom($pool[$i]->denom);
                $community_pool->setAmount($pool[$i]->amount);
                $community_pool->setTracked($stored);
                $community_pool->setToken(array_search($pool[$i]->denom,$token_list));
                $doctrine->persist($community_pool);
                $doctrine->flush();
            }
        }




    }


}

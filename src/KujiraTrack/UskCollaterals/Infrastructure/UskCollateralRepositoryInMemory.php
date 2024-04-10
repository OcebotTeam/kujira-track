<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Infrastructure;

use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollateralRepository;
use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollateral;
use Ocebot\KujiraTrack\UskCollaterals\Domain\UskCollaterals;

class UskCollateralRepositoryInMemory implements UskCollateralRepository
{
 protected array $collaterals = [];

 public function __construct(){

     $collateralsJson = file_get_contents(__DIR__ . '/UskCollaterals.json');
     $collaterals = json_decode($collateralsJson, true);
     foreach ($collaterals as $collateralData) {
         $this->collaterals[] = new UskCollateral(
             $collateralData["token"],
             $collateralData["address"],
             $collateralData["margin"]
         );
     }


 }

    public function findAll(): UskCollaterals
    {
        return new UskCollaterals($this->collaterals);
    }


    public function findByToken(string $token): ?UskCollateral
    {
        $collaterals = $this->findAll();

        foreach ($collaterals as $collateral) {
            if ($collateral->token() === $token) {
                return $collateral;
            }
        }
        return null;
    }
}
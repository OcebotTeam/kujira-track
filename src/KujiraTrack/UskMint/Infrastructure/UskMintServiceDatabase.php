<?php

namespace Ocebot\KujiraTrack\UskMint\Infrastructure;

use Ocebot\KujiraTrack\UskMint\Domain\UskMintService;
use \Ocebot\KujiraTrack\UskMint\Domain\UskMint;


class UskMintServiceDatabase implements UskMintService
{
    public function __construct(
        private readonly Database $database
    ){
    }

    public function requestUskMint(string $collateral): UskMint
    {
        $query = "SELECT * FROM usk_mint WHERE collateral = :collateral ORDER BY time DESC LIMIT 1";
        $stmt = $this->database->prepare($query);
        $stmt->execute(['collateral' => $collateral]);
        $result = $stmt->fetch();

        return new UskMint(
            $result['token'],
            $result['amount'],
            $result['time']
        );
    }
}
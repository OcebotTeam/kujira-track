<?php

namespace Ocebot\KujiraTrack\FinContracts\Infrastructure;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContract;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractRepository;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContracts;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractTickerId;

class FinContractRepositoryInMemoryDev implements FinContractRepository
{
    private array $finContracts = [];

    public function __construct()
    {
        $finContracts = [
//            // *** USDC PAIRS
//            "wETH_axlUSDC" => [
//                "contract" => "kujira1suhgf5svhu4usrurvxzlgn54ksxmn8gljarjtxqnapv8kjnp4nrsqq4jjh",
//                "decimals" => 12
//            ],
//            "axlUSDC_USDC" => [
//                "contract" => "kujira1zg4e37hz5hzlf8kmcaxjf85nyevk3qr2dp307lafdgst2928rghqed59ed"
//            ],
           "MNTA_USDC" => [
               "contract" => "kujira16mnw6am32ecqacsgz2kf9gfy8sh4uqyv0246f3rxnjz4up9k462q34jck5"
           ],

            // // *** USK PAIRS
            // "KUJI_USK" => [
            //     "contract" => "kujira193dzcmy7lwuj4eda3zpwwt9ejal00xva0vawcvhgsyyp5cfh6jyq66wfrf"
            // ],

//            // *** MNTA PAIRS
//
           "wETH_MNTA" => [
               "contract" => "kujira13xyuyw93pv6t7c4h248tc8t6kgu874v5qasmjfzqjfjhfp6hawlse5u5tz",
               "nominative" => "MNTA_USDC"
           ],
//
//            // *** wETH PAIRS
//            "wstETH_wETH" => [
//                "contract" => "kujira1ehwsdvgs3chpxuexktymjmmjj68m3h4q67p9vjj9rrgjqycc3gtsfzej24",
//                "nominative" => "wETH_axlUSDC",
//                "decimals" => 18
//            ]

        ];

        foreach ($finContracts as $tickerId => $contractValues) {
            $this->finContracts[] = new FinContract(
                $contractValues["contract"],
                $tickerId,
                $contractValues['decimals'] ?? 6,
                $contractValues['nominative'] ?? null
            );
        }
    }

    public function findAll(): FinContracts
    {
        return new FinContracts($this->finContracts);
    }

    public function findByTickerId(FinContractTickerId $tickerId): ?FinContract
    {
        $finContracts = $this->findAll();

        foreach ($finContracts as $finContract) {
            if ($finContract->tickerId() === $tickerId->value()) {
                return $finContract;
            }
        }

        return null;
    }
}

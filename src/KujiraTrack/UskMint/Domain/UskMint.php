<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DateTime;

class UskMint
{
    private readonly string $token;
    private readonly float $amount;
    private readonly DateTime $time;

    public function __construct(string $token, float $amount, string $time)
    {
        $this->token = $token;
        $this->amount = $amount;
        $this->time = new DateTime($time);
    }

    public function toArray()
    {
        return [
            "token" => $this->token,
            "amount" => $this->amount,
            "time" => (int) $this->time->unix(),
        ];
    }
}

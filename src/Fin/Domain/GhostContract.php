<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class GhostContract extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly GhostContractToken $token;

    public function __construct(string $address, string $token)
    {
        $this->address = new FinContractAddress($address);
        $this->token = new GhostContractToken($token);
    }

    public function address(): string
    {
        return $this->address;
    }

    public function token(): string
    {
        return $this->token->value();
    }

}

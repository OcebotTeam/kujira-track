<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

final class FinContracts extends Collection
{
    protected function type(): string
    {
        return FinContract::class;
    }
}

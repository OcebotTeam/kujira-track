<?php

namespace App\Domain;

final class FinContracts extends Collection
{
    protected function type(): string
    {
        return FinContract::class;
    }
}

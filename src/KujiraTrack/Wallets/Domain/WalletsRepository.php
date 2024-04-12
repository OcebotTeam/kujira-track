<?php

namespace Ocebot\KujiraTrack\Wallets\Domain;

interface WalletsRepository
{
    public function get(): WalletsCollection;

    public function store(Wallets $wallets): void;
}
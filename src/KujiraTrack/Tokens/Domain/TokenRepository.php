<?php

namespace Ocebot\KujiraTrack\Tokens\Domain;

interface TokenRepository
{
    public function findByTicker(string $ticker): ?Token;

    public function findByIbc(string $ibc): ?Token;

    public function findAll(): TokenCollection;
}

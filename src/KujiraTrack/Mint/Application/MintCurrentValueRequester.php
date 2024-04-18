<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Infrastructure\MintValueServiceLcd;

final class MintCurrentValueRequester
{
    public function __construct(
        private readonly MintValueServiceLcd $valueService
    ) {
    }

    public function __invoke(string $contractAddress): array
    {
        $mintCurrentValue = $this->valueService->request($contractAddress);

        return [
            "time" => $mintCurrentValue->time(),
            "value" => $mintCurrentValue->amount(),
        ];
    }
}

<?php

namespace Ocebot\KujiraTrack\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected string $value) {}

    final public function value(): string
    {
        return $this->value;
    }

    final public function __toString(): string
    {
        return $this->value();
    }
}
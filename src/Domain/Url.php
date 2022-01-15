<?php

namespace App\Domain;

final class Url implements ValueObject
{
    private string $url;

    private function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function fromString(string $url): self
    {
        //TODO: add validation here
        return new self($url);
    }

    public function toString(): string
    {
        return $this->url;
    }

    public function toEncode(): string
    {
        return urlencode($this->url);
    }

    public function equals(ValueObject $anObject): bool
    {
        return $anObject instanceof self &&
            $this->toString() === $anObject->toString();
    }
}
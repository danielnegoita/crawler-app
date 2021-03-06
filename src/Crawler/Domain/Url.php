<?php

namespace Crawler\Domain;

final class Url implements ValueObject
{
    private string $url;

    private function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function fromString(string $url): self
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException();
        }

        return new self($url);
    }

    public function host(): ?string
    {
        $url = parse_url($this->url);

        return $url['host'] ?? null;
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
<?php

namespace Crawler\Domain;

final class File implements ValueObject
{
    private string $filename;

    private string $content;

    private ?string $location;

    public function __construct(string $filename, string $content, ?string $location = null)
    {
        $this->filename = $filename;
        $this->content = $content;
        $this->location = $location;
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function location(): ?string
    {
        return $this->location;
    }

    public function path(): string
    {
        if(!$this->location) {
            return $this->filename;
        }

        return $this->location . '/' . $this->filename;
    }

    public function equals(ValueObject $anObject): bool
    {
        return $anObject instanceof self
            && $this->content === $anObject->content;
    }
}
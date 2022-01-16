<?php

namespace App\Domain;

final class File implements ValueObject
{
    private string $filename;

    private string $content;

    private string $path;

    public function __construct(string $filename, string $content, string $path)
    {
        $this->filename = $filename;
        $this->content = $content;
        $this->path = $path;
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function equals(ValueObject $anObject): bool
    {
        return $anObject instanceof self
            && $this->content === $anObject->content;
    }
}
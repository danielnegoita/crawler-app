<?php

namespace Crawler\Domain;

interface TemplateEngineInterface
{
    public function render(string $template, ?array $data = []): string;
}
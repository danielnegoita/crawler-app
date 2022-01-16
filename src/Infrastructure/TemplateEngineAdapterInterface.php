<?php

namespace App\Infrastructure;


interface TemplateEngineAdapterInterface
{
    public function render(string $template, ?array $data = []): string;
}
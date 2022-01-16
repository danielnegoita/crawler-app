<?php


namespace App\Domain;


interface TemplateEngineInterface
{
    public function render(string $template, ?array $data = []): string;
}
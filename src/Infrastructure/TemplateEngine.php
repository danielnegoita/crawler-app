<?php

namespace App\Infrastructure;


use App\Domain\TemplateEngineInterface;

class TemplateEngine implements TemplateEngineInterface
{
    private TemplateEngineAdapterInterface $templateEngineAdapter;

    public function __construct(TemplateEngineAdapterInterface $templateEngineAdapter)
    {
        $this->templateEngineAdapter = $templateEngineAdapter;
    }

    public function render(string $template, ?array $data = []): string
    {
        return $this->templateEngineAdapter->render($template, $data);
    }
}
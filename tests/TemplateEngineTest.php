<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Crawler\Infrastructure\TemplateEngine;
use Crawler\Infrastructure\Adapters\TwigAdapter;

class TemplateEngineTest extends TestCase
{
    public function testCanReplaceVariableInsideTemplate()
    {
        $twig = new TwigAdapter();

        $templateEngine = new TemplateEngine($twig);

        $html = $templateEngine->render(
            'sitemap-template.twig.html',
            ['links' => ["http://test.com", "http://test.com/about"]]
        );

        $this->assertStringContainsString('http://test.com', $html);
        $this->assertStringContainsString('http://test.com/about', $html);
    }
}

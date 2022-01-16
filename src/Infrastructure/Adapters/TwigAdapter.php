<?php

namespace App\Infrastructure\Adapters;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Infrastructure\TemplateEngineAdapterInterface;
use App\Application\Exceptions\UnableToRenderTemplate;

class TwigAdapter implements TemplateEngineAdapterInterface
{
    private $twig;

    public function __construct()
    {
        // TODO: move root path to .env
        $loader = new FilesystemLoader(dirname(__DIR__, 3) . '/templates');

        $this->twig = new Environment($loader);
    }

    /**
     * @param string $template
     * @param array|null $data
     * @return string
     * @throws UnableToRenderTemplate
     */
    public function render(string $template, ?array $data = []): string
    {
         try {
            return $this->twig->render($template, $data);
         } catch(Exception $e) {
            throw new UnableToRenderTemplate($e);
         }
    }
}
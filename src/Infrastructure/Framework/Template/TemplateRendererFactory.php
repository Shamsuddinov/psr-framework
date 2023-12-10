<?php

namespace Infrastructure\Framework\Template;

use Framework\Template\Twig\TwigRenderer;
use Psr\Container\ContainerInterface;
use Twig\Environment;

class TemplateRendererFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['templates'];
        return new TwigRenderer($container->get(Environment::class), $config['extension']);
    }
}

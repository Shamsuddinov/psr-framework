<?php

use Framework\Template\TemplateRenderer;
use Infrastructure\Framework\Template\TemplateRendererFactory;
use Infrastructure\Framework\Template\TwigEnvironmentFactory;

return [
    'dependencies' => [
        'factories' => [
            TemplateRenderer::class => TemplateRendererFactory::class,
            Twig\Environment::class => TwigEnvironmentFactory::class,
        ],
    ],
    'templates' => [
        'extension' => '.html.twig'
    ],
    'twig' => [
        'template_dir' => 'templates',
        'cache_dir' => 'var/cache/twig',
        'extensions' => [],
    ]
];
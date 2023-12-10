<?php

namespace Framework\Http\Middleware\ErrorHandler;

use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Stratigility\Utils;

class PrettyErrorResponseGenerator implements ErrorResponseGenerator
{
    private $template;
    private $views;
    private $response;

    public function __construct(TemplateRenderer $template, ResponseInterface $response, array $views)
    {
        $this->template = $template;
        $this->views = $views;
        $this->response = $response;
    }

    public function generate(\Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        $code = Utils::getStatusCode($e, new Response());

        $response = $this->response->withStatus($code);

        $response->getBody()->write($this->template->render($this->getView($code), [
            'request' => $request,
            'exception' => $e,
        ]));

        return  $response;
    }

    private function getView($code): string
    {
        if (array_key_exists($code, $this->views)){
            $view = $this->views[$code];
        } else {
            $view = $this->views['error'];
        }

        return $view;
    }
}
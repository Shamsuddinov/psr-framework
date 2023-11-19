<?php
namespace App\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class AboutAction
{
    public function __invoke(ServerRequestInterface $request): HtmlResponse
    {
        return new HtmlResponse('About page');
    }
}
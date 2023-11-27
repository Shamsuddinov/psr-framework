<?php
namespace App\Http\Action;

use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class HelloAction
{
    private $template;
    public function __construct(TemplateRenderer $template)
    {
        $this->template = $template;
    }

    public function __invoke()
    {
        return new HtmlResponse($this->template->render('hello'));
    }


// 5-3
//    private $template;
//
//    public function __construct(TemplateRenderer $template)
//    {
//        $this->template = $template;
//    }
//
//    public function __invoke(ServerRequestInterface $request)
//    {
//        $name = $request->getQueryParams()['name'] ?? 'Guest';
//
//        return new HtmlResponse($this->template->render('hello', [
//            'name' => 'Abbosxon'
//        ]));
//    }


// 5-2
//    public function __invoke(ServerRequestInterface $request)
//    {
//        $name = $request->getQueryParams()['name'] ?? 'Guest';
//
//        return new HtmlResponse($this->render('hello', [
//            'name' => 'Abbosxon'
//        ]));
//    }
//
//    private function render($view, $params = [])
//    {
//        extract($params, EXTR_OVERWRITE);
//
//        ob_start();
//        require 'templates/' . $view .'.php';
//        return ob_get_clean();
//    }


// 5-1
//    public function __invoke(ServerRequestInterface $request)
//    {
//        $name = $request->getQueryParams()['name'] ?? 'Guest';
//
//        $html = require 'templates/hello.php';
//
//        return new HtmlResponse($html);
//    }
}
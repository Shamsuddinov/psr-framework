<?php
namespace App\Http\Action\Blog;

use Psr\Http\Message\ServerRequestInterface;
use App\ReadModel\PostReadRepository;
use Framework\Template\TemplateRenderer;
use Zend\Diactoros\Response\HtmlResponse;

class IndexAction
{
    private $posts;
    private $template;

    public function __construct(PostReadRepository $posts, TemplateRenderer $template)
    {
        $this->posts = $posts;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request): HtmlResponse
    {
        $page = $request->getAttribute('page') ?: 1;

        $perPage = 3;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $total = $this->posts->countAll();
        $count = ceil($total/$perPage);

        $posts = $this->posts->getAll($offset, $limit);

        return new HtmlResponse($this->template->render('app/blog/index', [
            'posts' => $posts,
            'page' => $page,
            'count' => $count,
        ]));
    }
}

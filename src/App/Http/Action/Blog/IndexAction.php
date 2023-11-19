<?php
namespace App\Http\Action\Blog;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class IndexAction
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        return new JsonResponse([
            ['id' => 1, 'name' => 'Food']
        ]);
    }
}
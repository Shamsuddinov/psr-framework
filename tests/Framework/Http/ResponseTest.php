<?php
namespace Tests\Framework\Http;

use Framework\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testEmpty(){
        $response = new Response($body = 'body');

        self::assertEquals($body, $response->getBody());
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('OK', $response->getReasonPhrase());
    }

    public function test404(){
        $response = new Response($body = 'Empty', $status = 404);

        self::assertEquals($body, $response->getBody());
        self::assertEquals($status, $response->getStatusCode());
        self::assertEquals('Not found', $response->getReasonPhrase());
    }

    public function testHeaders(){
        $response = (new Response(''))
            ->withHeader($name = 'X-header-1', $value = 'value_1')
            ->withHeader($name_2 = 'X-header-2', $value_2 = 'value_2');

        self::assertEquals([$name => $value, $name_2 => $value_2], $response->getHeaders());
    }
}
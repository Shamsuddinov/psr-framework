<?php

namespace Tests\Framework\Http;

use Framework\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testEmpty(){
        $request = new Request();

        self::assertEquals([], $request->getQueryParams());
        self::assertEmpty($request->getParsedBody());
    }

    public function testQueryParams(){
        $request = new Request($data = [
            'name' => 'John',
            'age' => 28
        ]);

        self::assertEquals($data, $request->getQueryParams());
        self::assertEmpty($request->getParsedBody());
    }

    public function testParsedBody(){
        $request = new Request([], $data = ['title' => 'Title']);

        self::assertEquals([], $request->getQueryParams());
        self::assertEquals($data, $request->getParsedBody());
    }
}
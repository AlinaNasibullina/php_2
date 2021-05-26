<?php

use MyApp\Router;

class RouterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * 
     * @dataProvider parseProvider
     * @param $url
     * @param $expexted
     */
    public function testParse($url, $expexted)
    {
        $router = new \MyApp\Router([
            'login' => 'personalAccount/login',
            'logout' => 'personalAccount/logout',
            'orders' => 'admin/orders',
            'change' => 'admin/change',
            '(\w+)\/(\w+)' => '<controller>/<action>',
            '(\w+)' => '<controller>/index',
            '^$' => 'index/index',
            '(.*)' => 'index/error',
        ]);

        self::assertEquals($expexted, $router->parse($url));
    }

    public function parseProvider()
    {
        return [
            ['/login', ['personalAccount', 'login', []] ],
            ['/catalog', ['catalog', 'index', []] ],
            // ['/catalog/123/234', ['catalog', 'good', ['123', '234']] ],
            ['/', ['index', 'index', []] ],
            ['foo/bar', ['foo', 'bar', []] ],
            ['foo', ['foo', 'index', []] ],
        ];
    }

    /**
     * 
     * @dataProvider filterProvider
     * @param $expexted
     * @param $url
     * @return void
     */
    public function testFilter($expexted, $url)
    {
        self::assertEquals($expexted, Router::filter($url));
    }

    public function filterProvider()
    {
        return [
            ['login', '//login///'],
            ['personalAccount/login', '////personalAccount//login///'],
            ['', ''],
            ['', '/'],
            ['catalog', 'catalog'],
        ];
    }
}
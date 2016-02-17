<?php
namespace Beaver\SlimStatic\Tests;

use Slim\App as Slim;
use Beaver\SlimStatic\SlimStatic;

class ProxyTest extends \PHPUnit_Framework_TestCase
{
    protected $app;

    public function setUp()
    {
        $this->app = new Slim();
        Utils::setEnvironvment();

        SlimStatic::boot($this->app);

        // Allow any registered proxy in this namespace
        Statical::addNamespace('*', __NAMESPACE__.'\\*');
    }

    public function testApp()
    {
        $this->assertSame(App::getInstance(), $this->app);
    }

    public function testConfig()
    {
        $this->app->getContainer()['settings'] = ['debug' => true];
        $this->assertTrue(Config::get('debug'));
    }

    /**
    * Test Config fails when called with an App method
    *
    * @expectedException BadMethodCallException
    *
    */
    public function testConfigFailsBadMethod()
    {
        Config::root();
    }

    public function testContainer()
    {
        $this->assertSame(Container::getInstance(), $this->app->getContainer());
        Container::set('foo', 'bar');
        $this->assertSame('bar', $this->app->getContainer()['foo']);
    }

    public function testInput()
    {
        $this->assertSame(Input::getInstance(), $this->app->getContainer()['request']);
    }

    public function testRequest()
    {
        $this->assertSame(Request::getInstance(), $this->app->getContainer()['request']);
    }

    public function testResponse()
    {
        $this->assertSame(Response::getInstance(), $this->app->getContainer()['response']);
    }

    public function testRoute()
    {
        Route::get('/home', function () {})->setName('named');
        $expected = '/home';

        $this->assertEquals($expected, Router::pathFor('named'));
    }

    /**
    * Test Route fails when called with an App method
    *
    * @expectedException BadMethodCallException
    *
    */
    public function testRouteFailsBadMethod()
    {
        $appName = Route::getName();
    }
}

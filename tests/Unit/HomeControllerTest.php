<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

class HomeControllerTest extends TestCase
{
    /**
     * Test that the home controller index method returns a view.
     *
     * @return void
     */
    public function testHomeControllerIndexReturnsView()
    {
        $controller = new HomeController();
        $request = Request::create('/', 'GET');
        
        $response = $controller->index($request);
        
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('home', $response->name());
    }
}
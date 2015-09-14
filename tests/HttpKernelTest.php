<?php
/**
 * ...
 *
 * @author Nigel Greenway <nigel_greenway@me.com>
 * @license ...
 */

namespace Colonel\Test\Configuration;

use Colonel\HttpKernel;
use Colonel\Test\Fixtures\TestServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpKernelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Colonel\HttpKernel::handle
     * @covers \Colonel\HttpKernel::run
     */
    public function test_handle_is_successful()
    {
        $app = new HttpKernel([
            'debug' => false,
            'services' => [
                'di' => [
                    // Leave empty
                ],
            ],
            'routes' => [
                'test_group' => [
                    'test_route' => [
                        'pattern'    => '',
                        'controller' => function() {
                            return Response::create('<h1>It works!</h1>', 200);
                        },
                        'method'     => 'GET',
                    ],
                ],
            ],
        ]);

        $request = Request::createFromGlobals();

        $response = $app->handle(
            $request,
            1,
            true
        );

        $this->assertEquals('<h1>It works!</h1>', $response->getContent());
    }

    /**
     * @covers \Colonel\HttpKernel::handle
     * @covers \Colonel\HttpKernel::run
     */
    public function test_handle_is_successful_with_a_service_provider()
    {
        $app = new HttpKernel([
            'debug' => false,
            'services' => [
                'di' => [
                    // Leave empty
                ],
            ],
            'routes' => [
                'test_group' => [
                    'test_route' => [
                        'pattern'    => '',
                        'controller' => function() {
                            return Response::create('<h1>It works!</h1>', 200);
                        },
                        'method'     => 'GET',
                    ],
                ],
            ],
            'service_providers' => [
                TestServiceProvider::class => new TestServiceProvider()
            ],
        ]);

        $request = Request::createFromGlobals();

        $response = $app->handle(
            $request,
            1,
            true
        );

        $this->assertEquals('<h1>It works!</h1>', $response->getContent());
        $this->assertTrue($app->container->isSingleton(\stdClass::class));
    }
}

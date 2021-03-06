<?php
/** @license See LICENSE.md */
namespace Colonel;

/** @author  Nigel Greenway <github@futurepixels.co.uk> */
interface ServiceProviderInterface
{
    /**
     * Run code before `HttpKernel#handle` dispatches the router
     *
     * @param HttpKernel $httpKernel
     *
     * @return void
     */
    public function boot(HttpKernel $httpKernel);

    /**
     * Run code after the response has been sent back to the client
     * 
     * @param HttpKernel $httpKernel
     *
     * @return void
     */
    public function terminate(HttpKernel $httpKernel);
}
<?php

namespace Tests\Controller;

use \Controller\LandingController;
use \Lib\Service\ListingContent;

/**
 * ExampleControllerTest
 *
 * @package Tests
 */
class ExampleComplexControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $container;
    protected $stub;
    protected $apiCaller;

    /**
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    public function setUp()
    {
        parent::setUp();
        $this->kernel = new \AppKernel('test', true);
        $this->kernel->boot();
        $this->container = $this->kernel->getContainer();
        $this->container->set('listing_content', new ListingContent());

        $this->apiCaller = $this->container->get('api_caller');

        $this->stub = new ExampleController();
        $this->stub->setContainer($this->container);
    }

    /**
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    public function testSetFeaturedHandler()
    {
        $reflector = new \ReflectionClass('Controller\ExampleController');
        $method = $reflector->getMethod('setFeaturedHandler');
        $method->setAccessible(true);

        $result = $method->invokeArgs($this->stub, [$this->apiCaller, null, 'gadgets']);
        $this->assertNotNull($result);
    }
}
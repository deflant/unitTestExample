<?php

namespace Tests\Controller;

use Acme\Entity\GenericEdito;
use Symfony\Component\VarDumper\Caster\ReflectionCaster;

/**
 * ExampleControllerTest
 *
 * @package Tests
 */
class ExampleControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $data;
    protected $stub;

    /**
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    public function setUp()
    {
        $this->data = new GenericEdito();
        $this->data->set('category', 'facebook');
        //The mock spy a real controller
        $this->stub = $this->getMock('Controller\ExampleController');
    }

    /**
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    public function testSelectTag()
    {
        $tests = array(
            'facebook',
            'apple',
            'facebook'
        );
        //Allow selectTag who is a private method to be call
        $reflector = new \ReflectionClass('Controller\ExampleController');
        $method = $reflector->getMethod('selectTag');
        $method->setAccessible(true);

        //Tests 1
        $result = $method->invokeArgs($this->stub, array($this->data));
        $this->assertEquals($tests[0], $result);
        //return facebook

        //Tests 2
        $this->data->set('tags', 'apple');
        $result = $method->invokeArgs($this->stub, array($this->data));
        $this->assertEquals($tests[1], $result);
        //return apple

        //Tests 3 shoudn't return master tag 'facebook'
        $this->data->set('tags', array('apple', 'microsoft'));
        $result = $method->invokeArgs($this->stub, array($this->data));
        $this->assertNotSame($tests[2], $result);
        //return apple or microsoft
    }
}

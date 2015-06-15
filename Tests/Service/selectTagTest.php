<?php

namespace Tests\Service;

use Acme\Entity\GenericEdito;
use Acme\Service\SelectTag;
use Symfony\Component\VarDumper\Caster\ReflectionCaster;

/**
 * SelectTagTest
 *
 * @package Acme\Tests\Lib\Service
 */
class SelectTagTest extends \PHPUnit_Framework_TestCase
{
    protected $data;
    protected $stub;

    /**
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.co>
     */
    public function setUp()
    {
        $this->data = new GenericEdito();
        $this->data->set('category', 'facebook');
        $this->stub = new RelatedContent();
    }

    /**
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.co>
     */
    public function testSelectTag()
    {
        $tests = array(
            'facebook',
            'apple',
            'facebook',
        );
        //Allow selectTag who is a private method to be call
        $reflector = new \ReflectionClass($this->stub);
        $method = $reflector->getMethod('selectTag');
        $method->setAccessible(true);

        //Test 1
        $result = $method->invokeArgs($this->stub, array($this->data));
        $this->assertEquals($tests[0], $result);

        //Test 2
        $this->data->set('tags', 'apple');
        $result = $method->invokeArgs($this->stub, array($this->data));
        $this->assertEquals($tests[1], $result);

        //Test 3 shoudn't return master tag 'facebook'
        $this->data->set('tags', array('apple', 'microsoft'));
        $result = $method->invokeArgs($this->stub, array($this->data));
        $this->assertNotSame($tests[2], $result);
    }
}

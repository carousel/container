<?php
require __DIR__ . '../../vendor/autoload.php';
require 'Car.php';

use Carousel\Container;


class ContainerTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->container = new Container;
    }

    /**
     * @test
     * Test that object can be bound and resolved out of container
     */
    public function bound_and_check_object_in_container()
    {
        $this->container->bind('car',function(){ 
            return new Car;
        });
        $this->assertEquals(true,$this->container->isBound('car'));
        $this->assertNotEquals(true,$this->container->isBound('other_car'));
        $car = $this->container->resolve('car');
        $car->setMake('VW');
        $this->assertEquals('VW',$car->getMake());
        $this->assertEquals($this->container->isBound('car'),1);

    }
    /**
     * @test
     * Test that container implements interface
     */
    public function container_implements_interface()
    {
        $interface = class_implements(new Container);
        foreach($interface as $i){
            $this->assertEquals('Carousel\ContainerInterface',$i);
        }

    }
}

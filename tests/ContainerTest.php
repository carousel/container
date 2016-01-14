<?php
require __DIR__ . '../../vendor/autoload.php';
require 'Car.php';
require 'NewCar.php';

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
    public function check_if_object_is_bound_in_container()
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
    /**
     * @test
     * Test that binding key can be changed
     */
    public function binding_key_can_be_swapped()
    {
        $this->container->bind('car',function(){ 
            return new Car;
        });
        $this->container->swapKey('car','new_car');
        $new_car = $this->container->resolve('new_car');
        $this->assertTrue($new_car instanceof Car);
        $this->assertTrue($this->container->isBound('new_car'));
    }
    /**
     * @test
     * Test that binding implementation can be changed
     */
    public function binding_implementation_can_be_swapped()
    {
        $this->container->bind('car',function(){ 
            return new Car;
        });
        $this->container->swapConcrete('car',function(){ return new NewCar;});
        $car = $this->container->resolve('car');
        $this->assertTrue($car instanceof NewCar);
        $this->assertTrue($this->container->isBound('car'));
    }
}

<?php

use Carousel\Container;
use Tests\NewCar;
use Tests\Car;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->container = new Container();
    }

    /**
     * @test
     * Test that object can be bound and resolved out of container
     */
    public function object_can_be__bound_in_container()
    {
        $this->container->bind('car', function () {
            return new Car();
        });
        $this->assertEquals(true, $this->container->isBound('car'));
        $this->assertNotEquals(true, $this->container->isBound('other_car'));
        $car = $this->container['car'];
        $car->setMake('VW');
        $this->assertEquals('VW', $car->getMake());
        $this->assertEquals($this->container->isBound('car'), 1);
    }
    /**
     * @test
     * Test that binding key can be changed
     */
    public function binding_key_can_be_swapped()
    {
        //using ArrayAccess interface
        $this->container['car'] = function () {
            return new Car();
        };
        $this->container->swapKey('car', 'new_car');
        $new_car = $this->container['new_car'];
        $this->assertTrue($new_car instanceof Car);
        $this->assertTrue($this->container->isBound('new_car'));
    }
    /**
     * @test
     * Test that binding implementation can be changed
     */
    public function binding_implementation_can_be_swapped()
    {
        $this->container->bind('car', function () {
            return new Car();
        });
        $this->container->swapConcrete('car', function () {
            return new NewCar();
        });
        $car = $this->container['car'];
        $this->assertTrue($car instanceof NewCar);
        $this->assertTrue($this->container->isBound('car'));
    }
    /**
     * @test
     * Test that binding exists
     */
    public function binding_exists()
    {
        $this->container['car'] = function () {
            return new Car();
        };
        $this->assertTrue($this->container->isBound('car'));
        //$this->container->remove('car');
    }
    /**
     * @test
     * Test that binding can be removed
     */
    public function binding_can_be_removed()
    {
        $this->container['car'] = function () {
            return new Car();
        };
        $this->assertTrue($this->container->isBound('car'));
        $this->container->remove('car');
        $this->assertNotTrue($this->container->isBound('car'));
    }
    /**
     * @test
     * Test that binding can be removed
     */
    public function exception_is_thrown()
    {
        try {
            $this->container['car'];
        } catch (Exception $e) {
            $this->assertEquals(get_class($e), 'Carousel\Exceptions\BindingNotFoundException');
            $this->assertEquals($e->getMessage(), 'Container Binding Could Not Be Found!!!');
        }
    }
}

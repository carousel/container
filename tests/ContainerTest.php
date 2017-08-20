<?php

use Carousel\Container;
use Tests\Car;
use Tests\NewCar;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->container = new Container();
    }

    /**
     * @test
     *
     * Test that object can be bound and resolved out of container
     */
    public function objectCanBeBoundToContainer()
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
    public function bindingKeyCanBeSwapped()
    {
        //using ArrayAccess interface
        $this->container['car'] = function () {
            return new Car();
        };
        $this->container->swapKey('car', 'newCar');
        $newCar = $this->container['newCar'];
        $this->assertTrue($newCar instanceof Car);
        $this->assertTrue($this->container->isBound('newCar'));
    }
    /**
     * @test
     * Test that binding implementation can be changed
     */
    public function bindingImplementationCanBeSwapped()
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
    public function bindingExists()
    {
        $this->container['car'] = function () {
            return new Car();
        };
        $this->assertTrue($this->container->isBound('car'));
    }
    /**
     * @test
     * Test that binding can be removed
     */
    public function bindingCanBeRemoved()
    {
        $this->container['car'] = function () {
            return new Car();
        };
        $this->assertTrue($this->container->isBound('car'));
        $this->container->remove('car');
        $this->assertNotTrue($this->container->isBound('car'));
    }
}

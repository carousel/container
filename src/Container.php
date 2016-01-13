<?php

namespace Carousel;

class Container implements ContainerInterface
{
    public $bindings = [];
    /**
     * Bind object into the container
     * @param string
     * @param closure
     * @return void
     */
    public function bind($name,$callback)
    {
        $this->bindings[$name] = $callback;
    }

    /**
     * Resolve bindings from container
     *
     * @param string|name
     * @return object
     */
    public function resolve($name)
    {
        return $this->bindings[$name]();
    }

    /**
     * Check if object is bound in container
     *
     * @param string
     * @return boolean
     */
    public function isBound($name)
    {
        return array_key_exists($name,$this->bindings);
    }
}

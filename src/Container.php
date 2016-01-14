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
        if(array_key_exists($name,$this->bindings)){
            return array_key_exists($name,$this->bindings);
        }
    }
    /**
     * Swap binding key in container
     *
     * @param string
     * @param string
     * @return void
     */
    public function swapKey($old_name,$new_name)
    {
        if(array_key_exists($old_name,$this->bindings)){
            $backup[$new_name] = $this->bindings[$old_name];
            unset($this->bindings[$old_name]);
            $this->bindings[$new_name] = $backup[$new_name];
        }
    }
    /**
     * Swap binding implementation in container
     *
     * @param string
     * @param string
     * @param closure
     * @return void
     */
    public function swapConcrete($name,$callback)
    {
        if(array_key_exists($name,$this->bindings)){
            $this->bindings[$name] = $callback;
        }
    }
}

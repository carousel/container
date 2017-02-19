<?php

namespace Carousel;

use ArrayAccess;
use Carousel\Exceptions\BindingNotFoundException;

class Container implements ContainerInterface, ArrayAccess
{
    public $bindings = [];
    /**
     * Bind object into the container.
     *
     * @param string
     * @param callable
     * @return void
     */
    public function bind($name, $callback)
    {
        $this->bindings[$name] = $callback;
    }

    /**
     * Resolve bindings from container.
     *
     * @param string|name
     *
     * @return object
     */
    public function resolve($name)
    {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]();
        } else {
            throw new BindingNotFoundException();
        }
    }
    /**
     * Remove binding from container.
     *
     * @param string
     * @return void
     */
    public function remove($name)
    {
        $this->offsetUnset($name);
    }

    /**
     * Check if object is bound in container.
     *
     * @param string
     *
     * @return bool
     */
    public function isBound($name)
    {
        return $this->offsetExists($name);
    }
    /**
     * Swap binding key in container.
     *
     * @param string
     * @param string
     * @return void
     */
    public function swapKey($old_name, $new_name)
    {
        if (array_key_exists($old_name, $this->bindings)) {
            $backup[$new_name] = $this->bindings[$old_name];
            unset($this->bindings[$old_name]);
            $this->bindings[$new_name] = $backup[$new_name];
        }
    }
    /**
     * Swap binding implementation in container.
     *
     * @param string
     * @param string
     * @param callable
     */
    public function swapConcrete($name, $callback)
    {
        if (array_key_exists($name, $this->bindings)) {
            $this->bindings[$name] = $callback;
        }
    }
    /**
     * Check if binding exists.
     *
     * @param string
     *
     * @return bool
     */
    public function offsetExists($name)
    {
        if (array_key_exists($name, $this->bindings)) {
            return array_key_exists($name, $this->bindings);
        }
    }
    /**
     * Get binding (resolve) from container.
     *
     * @param string
     *
     * @return bool
     */
    public function offsetGet($name)
    {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]();
        } else {
            throw new BindingNotFoundException();
        }
    }
    /**
     * Bind into the container.
     *
     * @param string
     * @param callable
     */
    public function offsetSet($name, $callback)
    {
        $this->bindings[$name] = $callback;
    }
    /**
     * Remove binding from the container.
     *
     * @param string
     * @param callable
     *
     * @return bool
     */
    public function offsetUnset($name)
    {
        unset($this->bindings[$name]);
    }
}

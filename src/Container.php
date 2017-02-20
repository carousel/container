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
     */
    public function bind($key, callable $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * Resolve bindings from container.
     *
     * @param string|name
     *
     * @return object
     */
    public function resolve($key)
    {
        if (isset($this->bindings[$key])) {
            return $this->bindings[$key]();
        } else {
            throw new BindingNotFoundException();
        }
    }
    /**
     * Remove binding from container.
     *
     * @param string
     */
    public function remove($key)
    {
        $this->offsetUnset($key);
    }

    /**
     * Check if object is bound in container.
     *
     * @param string
     *
     * @return bool
     */
    public function isBound($key)
    {
        return $this->offsetExists($key);
    }
    /**
     * Swap binding key in container.
     *
     * @param string
     * @param string
     */
    public function swapKey($key, $newKey)
    {
        if (array_key_exists($key, $this->bindings)) {
            $backup[$key] = $this->bindings[$key];
            unset($this->bindings[$key]);
            $this->bindings[$newKey] = $backup[$key];
        }
    }
    /**
     * Swap binding implementation in container.
     *
     * @param string
     * @param string
     * @param callable
     */
    public function swapConcrete($key, callable $resolver)
    {
        if (array_key_exists($key, $this->bindings)) {
            $this->bindings[$key] = $resolver;
        }
    }
    /**
     * Check if binding exists.
     *
     * @param string
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        if (array_key_exists($key, $this->bindings)) {
            return array_key_exists($key, $this->bindings);
        }
    }
    /**
     * Get binding (resolve) from container.
     *
     * @param string
     *
     * @return bool
     */
    public function offsetGet($key)
    {
        if (isset($this->bindings[$key])) {
            return $this->bindings[$key]();
        } else {
            throw new BindingNotFoundException();
        }
    }
    /**
     * Bind into the container.
     *
     * @param string
     * @param object | value
     */
    public function offsetSet($key, $value)
    {
        $this->bindings[$key] = $value;
    }
    /**
     * Remove binding from the container.
     *
     * @param string
     * @param callable
     *
     * @return bool
     */
    public function offsetUnset($key)
    {
        unset($this->bindings[$key]);
    }
}

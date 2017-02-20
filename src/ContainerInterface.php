<?php

namespace Carousel;

interface ContainerInterface
{
    /**
     * Bind object into the container.
     *
     * @param string
     * @param closure
     */
    public function bind($key, callable $resolver);

    /**
     * Resolve bindings from container.
     *
     * @param string|name
     *
     * @return object
     */
    public function resolve($key);

    /**
     * Check if object is bound in container.
     *
     * @param string
     *
     * @return bool
     */
    public function isBound($key);
    /**
     * Remove binding from  container.
     *
     * @param string
     *
     * @return bool
     */
    public function remove($key);
    /**
     * Swap key (alias) in container.
     *
     * @param string
     *
     * @return bool
     */
    public function swapKey($key, $newKey);
    /**
     * Swap implementation in container.
     *
     * @param string
     *
     * @return bool
     */
    public function swapConcrete($key, callable $resolver);
}

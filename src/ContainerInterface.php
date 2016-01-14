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
    public function bind($name, $callback);

    /**
     * Resolve bindings from container.
     *
     * @param string|name
     *
     * @return object
     */
    public function resolve($name);

    /**
     * Check if object is bound in container.
     *
     * @param string
     *
     * @return bool
     */
    public function isBound($name);
    /**
     * Remove binding from  container.
     *
     * @param string
     *
     * @return bool
     */
    public function remove($name);
    /**
     * Swap key (alias) in container.
     *
     * @param string
     *
     * @return bool
     */
    public function swapKey($old_name, $new_name);
    /**
     * Swap implementation in container.
     *
     * @param string
     *
     * @return bool
     */
    public function swapConcrete($name, $callback);
}

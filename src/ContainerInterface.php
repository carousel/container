<?php
namespace Carousel;

interface ContainerInterface 
{
    /**
    * Bind object into the container
    * @param string
    * @param closure
    * @return void
    */
    public function bind($name,$callback);

    /**
    * Resolve bindings from container
    *
    * @param string|name
    * @return object
    */
    public function resolve($name);

    /**
    * Check if object is bound in container
    *
    * @param string
    * @return boolean
    */
    public function isBound($name);
        
}

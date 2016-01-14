<?php

class NewCar 
{
    protected $make;
    /**
     * Set car make
     *
     * @param string
     * @return void 
    */
    public function setMake($make)
    {
        $this->make = $make;        
    }
    /**
     * Get car make
     *
     * @return string|car make
    */
    public function getMake()
    {
        return $this->make;
    }
}

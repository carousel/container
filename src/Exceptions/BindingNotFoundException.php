<?php

namespace Carousel\Exceptions;

use Exception;

class BindingNotFoundException extends Exception
{
    protected $message = 'Container binding could not be found';
}

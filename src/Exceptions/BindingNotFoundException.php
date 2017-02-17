<?php

namespace Carousel\Exceptions;

use Exception;

class BindingNotFoundException extends Exception
{
    protected $message = 'Container Binding Could Not Be Found!!!';
}

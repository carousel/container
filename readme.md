#Simple dependency injection container for PHP projects
[![Build Status](https://travis-ci.org/carousel/container.svg)](https://travis-ci.org/carousel/container)


## Installation

### With Composer

```
$ composer require carousel/container
```

composer.json
```
{
    "require": {
        "carousel/container": "0.4.0"
    }
}
```

## Usage

```php
//bind object into the container (using ArrayAccess)
$this->container['car'] = function () { return new Car(); };

//resolve
$car = $this->container['car'];

//call object method
$car->setMake('VW');

//swap binding key
$this->container->swapKey('car', 'new_car');

//resolve
$new_car = $this->container['new_car'];

```

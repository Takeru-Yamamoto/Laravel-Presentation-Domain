<?php

namespace MyCustom\Services;

use MyCustom\Services\Crypt;
use MyCustom\Services\Event;
use MyCustom\Services\Numeric;
use MyCustom\Services\Paginate;
use MyCustom\Services\Sns;

/**
 * BaseServiceでuseするtrait
 */
trait ServiceTraits
{
    use Crypt, Event, Numeric, Paginate, Sns;
}

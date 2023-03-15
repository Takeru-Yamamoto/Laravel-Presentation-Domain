<?php

namespace MyCustom\Controllers;

use MyCustom\Controllers\Redirect;
use MyCustom\Controllers\Text;
use MyCustom\Controllers\View;

/**
 * BaseControllerでuseするtrait
 */
trait ControllerTraits
{
    use Redirect, Text, View;
}

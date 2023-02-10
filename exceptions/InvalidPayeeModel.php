<?php

namespace Syehan\Gamify\Exceptions;

use Exception;

class InvalidPayeeModel extends Exception
{
    protected $message = 'payee() method must return a model which will get the points.';
}

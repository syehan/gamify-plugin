<?php

namespace Syehan\Gamify\Exceptions;

use Exception;

class PointSubjectNotSet extends Exception
{
    protected $message = 'Initialize $subject field in constructor.';
}

<?php

namespace App\Exceptions;

use Exception;

class InvalidApproverException extends Exception
{
    public function __construct($message = "Invalid data provided", $code = 422, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace App\Core\exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = "You are not authorized to visit this page.";
    protected $code = 403; 
}
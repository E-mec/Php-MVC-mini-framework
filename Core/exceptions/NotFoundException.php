<?php

namespace App\Core\exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = "Sorry, Page Not Found.";
    protected $code = 404; 
}
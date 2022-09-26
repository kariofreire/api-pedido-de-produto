<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * Construct
     * 
     * @param String $message
     * @param Int $code
     * @param Exception|null $anterior
     * 
     * @return Void
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

   /**
    * To String
    *
    * @return String
    */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
    }
}
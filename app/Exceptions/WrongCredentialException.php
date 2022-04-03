<?php

namespace App\Exceptions;

use Exception;

class WrongCredentialException extends Exception
{
    protected $message = 'Email ou senha incorreto.';
    protected $code = '401';

    /**
     * @param string $message
     * @param string $code
     */
    public function __construct(string $message, string $code)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message,$code);
    }


}

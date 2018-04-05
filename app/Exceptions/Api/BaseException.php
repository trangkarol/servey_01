<?php

namespace App\Exceptions\Api;

use Exception;

abstract class BaseException extends Exception
{
    protected $code = null;
    protected $message = null;

    public function __construct(
        $message = null, 
        $code = null
    ) {
        if (!$code || !is_numeric($code)) {
            $code = INTERNAL_SERVER_ERROR;
        }

        $message = $message ?: translate('status_code.' . $code);

        $this->code = $code;
        $this->message = $message;

        parent::__construct($message, $code);
    }

    public function getErrorMessage()
    {
        return $this->message;
    }

    public function getStatusCode()
    {
        return $this->code;
    }
}

<?php

namespace App\Exceptions\Api;

class NotFoundException extends BaseException
{
    public function __construct(
    	$message = null, 
    	$code = NOT_FOUND
    ) {
        $message = $message ?: trans('status_code.' . $code);

        parent::__construct($message, $code);
    }
}

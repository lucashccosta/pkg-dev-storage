<?php

declare(strict_types=1);

namespace Dev\Storage\Exceptions;

use Exception;

class UploadException extends Exception
{
    const DEFAULT_MESSAGE = 'Upload file error';
    const DEFAULT_CODE = 2001;

    public function __construct(?string $message = null, ?int $code = null) 
    {
        parent::__construct(
            message: $message ?? self::DEFAULT_MESSAGE,
            code: $code ?? self::DEFAULT_CODE
        );
    }
}

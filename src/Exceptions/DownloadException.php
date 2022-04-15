<?php

declare(strict_types=1);

namespace Dev\Storage\Exceptions;

use Exception;

class DownloadException extends Exception
{
    const DEFAULT_MESSAGE = 'Download file error';
    const DEFAULT_CODE = 2000;

    public function __construct(?string $message = null, ?int $code = null) 
    {
        parent::__construct(
            message: $message ?? self::DEFAULT_MESSAGE,
            code: $code ?? self::DEFAULT_CODE
        );
    }
}

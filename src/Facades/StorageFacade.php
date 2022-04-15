<?php

declare(strict_types=1);

namespace Dev\Storage\Facades;

use Dev\Storage\Contracts\IStorage;
use Dev\Storage\Exceptions\InvalidArgumentException;
use Dev\Storage\Storages\Aws\S3;

final class StorageFacade
{
    /**
     * @param array $config
     * @throws InvalidArgumentException
     * @return IStorage
     */
    public static function buildAwsS3(array $config): IStorage
    {
        return new S3($config);
    }
}

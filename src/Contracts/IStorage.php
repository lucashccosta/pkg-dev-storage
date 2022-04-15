<?php

declare(strict_types=1);

namespace Dev\Storage\Contracts;

use Dev\Storage\Entities\Response;
use Dev\Storage\Exceptions\DownloadException;
use Dev\Storage\Exceptions\UploadException;
use SplFileObject;

interface IStorage
{   
    /**
     * @param SplFileObject $file
     * @param string|null $path
     * @return Response
     * 
     * @throws UploadException
     */
    public function upload(SplFileObject $file, ?string $path = null): Response;

    /**
     * @param string $filename
     * @param string|null $path
     * @throws DownloadException
     * @return Response
     * 
     * 
     */
    public function download(string $filename, ?string $path = null): Response;
}

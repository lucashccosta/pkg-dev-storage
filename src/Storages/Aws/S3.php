<?php

declare(strict_types=1);

namespace Dev\Storage\Storages\Aws;

use Aws\S3\S3Client;
use Dev\Storage\Entities\Response;
use Dev\Storage\Contracts\IStorage;
use Dev\Storage\Exceptions\DownloadException;
use Dev\Storage\Exceptions\UploadException;
use Dev\Storage\Storages\Aws\S3Config;
use Exception;
use SplFileObject;

class S3 implements IStorage
{
    private S3Config $config;
    private S3Client $client;

    public function __construct(array $config)
    {
        $this->build($config);
    }

    public function upload(SplFileObject $file, ?string $path = null): Response
    {
        try {
            $storagePath = ($path ?? '') . time() . '_' . $file->getFilename();

            $result = $this->client->putObject([
                'Bucket' => $this->config->getBucket(),
                'Key' => $storagePath,
                'Body' => $file->fread($file->getSize()),
                'ACL' => $this->config->getAcl()
            ]);

            return new Response(
                statusCode: (int) $result['@metadata']['statusCode'],
                body: ['url' => $result['ObjectURL']],
                headers: $result['@metadata']['headers']
            );
        } catch (Exception $e) {
            throw new UploadException(
                message: UploadException::DEFAULT_MESSAGE . ': ' . $e->getMessage()
            );
        }
    }

    public function download(string $filename, ?string $path = null): Response
    {
        try {
            $file = sys_get_temp_dir() . '/' .$filename;

            $result = $this->client->getObject([
                'Bucket' => $this->config->getBucket(),
                'Key' => ($path ?? '') . $filename,
                'SaveAs' => $file
            ]);

            return new Response(
                statusCode: (int) $result['@metadata']['statusCode'],
                body: ['file' => new SplFileObject($file, 'r')],
                headers: $result['@metadata']['headers']
            );
        } catch (Exception $e) {
            throw new DownloadException(
                message: DownloadException::DEFAULT_MESSAGE . ': ' . $e->getMessage()
            );
        }
    }

    private function build(array $config): void
    {
        $this->config = new S3Config($config);
        $this->client = new S3Client([
            'version' => $this->config->getVersion(),
            'region' => $this->config->getRegion(),
            'credentials' => [
                'key' => $this->config->getAccessKey(),
                'secret' => $this->config->getSecretKey()
            ]
        ]);
    }
}

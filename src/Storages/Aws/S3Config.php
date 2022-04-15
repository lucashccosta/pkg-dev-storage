<?php

declare(strict_types=1);

namespace Dev\Storage\Storages\Aws;

use Dev\Storage\Storages\BaseConfig;

class S3Config extends BaseConfig
{
    protected string $accessKey;
    protected string $secretKey;
    protected string $region;
    protected string $bucket;
    protected string $acl;
    protected ?string $version;
    
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->build($config);
    }

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function getBucket(): string
    {
        return $this->bucket;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getAcl(): string
    {
        return $this->acl;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    protected function config(): array
    {
        return [
            'access_key',
            'secret_key',
            'region',
            'bucket',
            'acl'
        ];
    }

    private function build(array $config): void
    {
        $this->accessKey = $config['access_key'];
        $this->secretKey = $config['secret_key'];
        $this->region = $config['region'];
        $this->bucket = $config['bucket'];
        $this->acl = $config['acl'];
        $this->version = $config['version'] ?? 'latest';
    }
}

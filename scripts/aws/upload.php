<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Dev\Storage\Facades\StorageFacade;

$config = [
    'access_key' => 'ACCESS_KEY',
    'secret_key' => 'SECRET_KEY',
    'region' => 'REGION',
    'bucket' => 'BUCKET',
    'acl' => 'ACL'
];

$filename = __DIR__ . '/../assets/php.jpg';
$file = new SplFileObject($filename, 'r');

$s3 = StorageFacade::buildAwsS3($config);
$uploaded = $s3->upload($file, 'original/');

var_dump($uploaded);
die();

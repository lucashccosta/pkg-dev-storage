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

$filename = '1650040973_php.jpg';

$s3 = StorageFacade::buildAwsS3($config);
$downloaded = $s3->download($filename, 'original/');

var_dump($downloaded);
die();

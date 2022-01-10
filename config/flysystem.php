<?php
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

$client = new S3Client([
    'credentials' => [
        'key'    => 'AKIARH33NGKZI7WDX4HK',
        'secret' => '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',
    ],
    'region' => 'us-east-1',
    'version' => 'latest',
]);

$adapter = new AwsS3Adapter($client, 'restaurant-project',false);

$filesystem = new Filesystem($adapter);

?>
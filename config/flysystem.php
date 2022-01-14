<?php
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

$client = new S3Client([
    'credentials' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        
    ],
    'region' => 'us-east-1',
    'version' => 'latest',
]);

$adapter = new AwsS3Adapter($client, 'restaurant-project',false);

$filesystem = new Filesystem($adapter);

?>
<?php

use Aws\S3\S3Client;
require "../static/libs/aws/aws-autoloader.php";

$config = require('sec.php');

// $filepath should be absolute path to a file on disk
$filepath = '/var/www/html/guruchallenge/challenge/video.mp4';

// Instantiate the client.
$client = S3Client::factory([
  'key' =>$config['s3']['key'],
  'secret' =>$config['s3']['secret']


  ]);
  ?>

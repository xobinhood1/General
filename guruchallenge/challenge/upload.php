<?php
error_reporting(E_ALL);
session_start();
echo $_SESSION['pcid'];
use Aws\S3\Exception\S3Exception;
 require "start.php";

if (isset($_FILES['file'])) {
$file = $_FILES['file'];  # code...
$name = $_SESSION['pcid'].".mp4";
$tmp_name = $file['tmp_name'];
$extension = explode('.',$name);
$extension  = strtolower(end($extension));


// Temp details

$key = md5(uniqid());
$tmp_file_name = "{$key}.{$extension}";
$tmp_file_path = "files/{$tmp_file_name}";

// Move the file

move_uploaded_file($tmp_name,$tmp_file_path);

 $client->putObject(array(
  'Bucket' =>$config['s3']['bucket'],
  'Key' => "uploads/{$name}",
  'Body'=>fopen($tmp_file_path,'rb'),
  'ACL' => 'public-read'
));

//remove the file
unlink($tmp_file_path);


}
?>

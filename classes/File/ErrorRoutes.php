<?php
namespace File;

class ErrorRoutes
{
 
    

   public function getRoutes(): array{

    $routes = [
        0 => 'There is no error, the file has been successfully uploaded',
        1 => 'The uploaded file exceeds the upload_max filesize directive in php.ini',
        2 => 'The uploaed file exceeds the MAX_FILE_SIZE directive that is specified in HTML',
        3 => 'The upload file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failing to write file to disk',
        8 => 'A php extension stopped the file upload' 
    ];
    return $routes;
   } 
  
}
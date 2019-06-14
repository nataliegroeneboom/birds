<?php
namespace File;

class Upload
{

     public $image;
     private $uploadedImage;
     private $upload;
     private $isThere;

     //upload new image
    //delete old image
    //


    public function setImage($image)
    {
        $this->image = $image;

    }

    public function setUploadedImage($img)
    {
        $this->upload = $img;
        $this->uploadedImage = $img['image'];
        $this->uploadImage();

    }

    public function checkImageHasChanged(){
    //check if old image needs to be deleted
     if($this->image!==''&& isset($this->uploadedImage)){
         $dir = __DIR__ . '/../../public/files/' . $this->image;

         if(file_exists($dir)){
         return true;

         };
     }
     return false;


    }

    public function getImage(){
        return $this->image;
    }

    private function uploadImage(){
        $upload = $this->upload;
        if(isset($upload)){
            $path = __DIR__ . '/../../public/files/';

            $size = 420000;
            $target_file = $path . basename($upload);
            $allowedFiles = array('jpg', 'jpeg', 'png');
            $result = [];

            if(!empty($upload) && !empty($path) && !empty($size) && !empty($allowedFiles)){
                //check if upload and allowed are an array
                if(is_array($upload) && is_array($allowedFiles)){
                    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                    if(!in_array($file_type, $allowedFiles)){
                        $result['type'] = 'error';
                        //  $this->_result['message'] = "File should be less then ".$this->_size . "bytes";
                        $result['message'] = "Only JPG, JPEG, PNG, GIF files are allowed.";
                        $result['path'] = false;


                    }
                    if($upload['size'] > $size){
                        $result['type'] = 'error';
                        $result['message'] = "File should be less then ". $size . " bytes";
                        $result['path'] = false;
                    }
                    if(file_exists($target_file)){
                        $result['type'] = 'error';
                        $result['message'] = "Image already exists";
                        $result['path'] = false;
                    }
                    if(!isset($result['error'])){
                        if(move_uploaded_file($this->uploadedImage['tmp_name'], $target_file)){
                            $result['type'] = 'success';
                            $result['message'] = "Image uploaded";
                            $result['path'] = true;
                        }else{
                            $result['type'] = 'error';
                            $result['message'] = "Image unable to be upload";
                            $result['path'] = false;
                        }
                    }
                }
            }

        }

        return $result;


    }
}
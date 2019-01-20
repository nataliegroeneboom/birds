<?php

class UploadFile{

    private $_upload,
            $_dir,
            $_size,
            $_allowed,
            $_result = array();

    function __construct($upload=array(), $dir, $size, $allowed)
    {
        $this->_upload = $upload;
        $this->_dir = $dir;
        $this->_size = $size;
        $this->_allowed = $allowed;
    }

    public function Upload(){
        $file = sha1_file($this->_upload['tmp_name'] . '-' . basename($this->_upload['name']) );
        $target_file = $this->_dir . $file;
        if(!empty($this->_upload) && !empty($this->_dir) && !empty($this->_size) && !empty($this->_allowed)){
            //check if upload and allowed are an array
            if(is_array($this->_upload) && is_array($this->_allowed)){
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                if(!in_array($file_type, $this->_allowed)){
                    $this->_result['type'] = 'error';
                  //  $this->_result['message'] = "File should be less then ".$this->_size . "bytes";
                    $this->_message = "Only JPG, JPEG, PNG, GIF files are allowed.";
                    $this->_result['path'] = false;


                }
                if($this->_upload['size'] > $this->_size){
                    $this->_result['type'] = 'error';
                    $this->_result['message'] = "File should be less then ".$this->_size . "bytes";
                    $this->_result['path'] = false;
                }
                if(file_exists($target_file)){
                    $this->_result['type'] = 'error';
                    $this->_result['message'] = "Image already exists";
                    $this->_result['path'] = false;
                }
                if($this->_result['type'] !== 'error'){
                    if(move_uploaded_file($this->_upload['temp'], $target_file)){
                        $this->_result['type'] = 'success';
                        $this->_result['message'] = "Image uploaded";
                        $this->_result['path'] = true;
                    }else{
                        $this->_result['type'] = 'error';
                        $this->_result['message'] = "Image unable to be upload";
                        $this->_result['path'] = false;
                    }
                }
            }
        }

    return $this->_result;
//        $result_message="";
//        $file_upload_error_messages = "";
//        if($file){
//            $target_directory = "files/";
//            $target_file = $target_directory . $file;
//            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
//            $file_upload_error_message = '';
//
//
//            $check = getimagesize($_FILES["image"]["tmp_name"]);
//            if($check!==false){
//                // make sure certain file types are allowed
//                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
//                if(!in_array($file_type, $allowed_file_types)){
//                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
//                }
//                // make sure file does not exist
//                if(file_exists($target_file)){
//                    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
//                }
//                // make sure submitted file is not too large, can't be larger than 1 MB
//                if($_FILES['image']['size'] > (4024000)){
//                    $file_upload_error_messages.="<div>Image must be less than 4 MB in size.</div>";
//                }
//                // make sure the 'uploads' folder exists
//                // if not, create it
//                if(!is_dir($target_directory)){
//                    mkdir($target_directory, 0777, true);
//                }
//                // if $file_upload_error_messages is still empty
//                if(empty($file_upload_error_messages)){
//                    // it means there are no errors, so try to upload the file
//                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
//                        // it means photo was uploaded
//                    }else{
//                        $result_message.= "<div class='alert alert-danger'>";
//                        $result_message.=  "<div>Unable to upload photo.</div>";
//                        $result_message.=  "<div>Update the record to upload photo.</div>";
//                        $result_message.= "</div>";
//                    }
//                }
//
//                // if $file_upload_error_messages is NOT empty
//                else{
//                    // it means there are some errors, so show them to user
//                    $result_message.=  "<div class='alert alert-danger'>";
//                    $result_message.=  "<div>{$file_upload_error_messages}</div>";
//                    $result_message.=  "<div>Update the record to upload photo.</div>";
//                    $result_message.=  "</div>";
//                }
//            }else{
//                $file_upload_error_messages .="<div>
//      Submitted file is not an image.
//      </div>";
//
//            }
//
//        }
//        return $result_message;

    }



}
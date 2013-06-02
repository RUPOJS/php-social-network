<?php
   
   $name = $_FILES['Profile_pic']['name'];
   $type = $_FILES['Profile_pic']['type'];
   $error = $_FILES['Profile_pic']['error'];
   $tmp_name = $_FILES['Profile_pic']['tmp_name'];
   $directory = "images/";
   
   if($error>0){
      return "Error on Uploading File =>".$error;
   }else if($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
      
      if(file_exists($directory.$name)){
         return "Picture Already Exist!";
      }else{
         move_uploaded_file($tmp_name, $directory.$name);
         return $directory.$name;
      }
   }else{
      return 'Unsupported Format';
   }


?>

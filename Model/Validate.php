<?php          

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Validate {
        
    public $db;
    public function __construct(){
			$this->db = mysqli_connect(__HOST__,__USER__,__PASS__, __DB__);

			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}
    
    public  function validateUser($username){
        $sql="select * from users where user_name='".$username."';";
        $result= mysqli_query($this->db, $sql);

        if ($result->num_rows==0){
            return True;
        }else{
            return FALSE;
        }
        
    }
    
    public  function validatePAssword($password,$password_confirm){
        if (strlen($password)> 8 && ($password ===$password_confirm)){
            return TRUE;
    
        }else{
            return FALSE;
        }
    }
    public function validateimage($FILE){
     if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        //  var_dump(__ALLOWEDIMAGE__);
        $allowedImage = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
     
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        $maxsize = __MAXSIZE__;
        if((in_array($filetype, $allowedImage)&&$filesize<$maxsize)){
            return TRUE;
        } else{
            return FALSE;
        }
    } 
    }
    public function validatecv($FILE){
     if(isset($_FILES["cv"]) && $_FILES["cv"]["error"] == 0){
        $allowedCV = array("pdf" => "application/pdf");
        $filetype = $_FILES["cv"]["type"];
        $filesize = $_FILES["cv"]["size"];

        $maxsize = __MAXSIZE__;
        if((in_array($filetype, $allowedCV)&& $filesize<$maxsize)){
            return TRUE;
        } else{
            return FALSE;
        }
    } 
    }
}
?>
    
}

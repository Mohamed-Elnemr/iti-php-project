<?php
require_once "autoload.php";

	class User{

		public $db;

		public function __construct(){
			@$this->db =new mysqli(__HOST__, __USER__, __PASS__, __DB__);
			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}

		/*** for registration process ***/

		public function reg_user($username,$password,$name,$job,$image_name,$cv_name){

			//$password = hash('sha256', $_POST['ppasscode']);
			$password = hash('sha256', $password);
		
			$sql="SELECT * FROM users WHERE user_name='$username'";

			//checking if the username or email is available in db
			$check =  $this->db->query($sql) ;
			$count_row = $check->num_rows;

			//if the username is not in db then insert to the table
			if ($count_row == 0)
			{
				$sql=$this->db->prepare("INSERT INTO users(user_name,password,name,job,	image_name,cv_name)VALUES(?,?,?,?,?,?) ");
				$sql->bind_param("ssssss",$username,$password, $name, $job,$image_name,$cv_name);
			    return $sql->execute();
			}
			else
		    {return false;}
		}

		/*** for login process ***/
		public function check_login($username,$password,$remember){
            //echo $password."<br>";
			$pass = hash('sha256', $password);
			//echo $pass;
			$sql2="SELECT id,administrator from users WHERE user_name='$username' AND password='$pass'";

			//checking if the username is available in the table
        	$result = mysqli_query($this->db,$sql2);
        	$user_data = mysqli_fetch_array($result);
			$count_row = $result->num_rows;
			
		   
		    
	        if ($count_row == 1) {
	            // this login var will use for the session thing
	            $_SESSION['login'] = true;
				$_SESSION['user_id'] = $user_data['id'];
				$_SESSION['administrator'] = $user_data['administrator'];
				if($remember==="on")
				{  $hour = time() + 3600 * 24 * 30;
				   setcookie('user_postion', $user_data['administrator'], $hour);	
				   setcookie('user_id', $user_data['id'], $hour);	
				}
	            return true;
	        }
	        else{
			    return false;
			}
    	}

    	/*** for showing the username or fullname ***/
    	public function get_username($uid){
    		$sql3="SELECT fullname FROM users WHERE id = $uid";
	        $result = mysqli_query($this->db,$sql3);
	        $user_data = mysqli_fetch_array($result);
	        return $user_data['fullname'];
		}
		public function saveImage($FILE){
            // if(file_exists($FILE))
            $filename = $_FILES["photo"]["name"];
             $filetype = $_FILES["photo"]["type"];
             $filesize = $_FILES["photo"]["size"];
             $uploads_dir = __IMAGESPATH__;
             

            move_uploaded_file($_FILES["photo"]["tmp_name"], $uploads_dir.$_POST['username'].".jpg");
//                echo "Your file was uploaded successfully.";

            
        }
        public function saveCV($FILE){
             $filename = $_FILES["cv"]["name"];
             $filetype = $_FILES["cv"]["type"];
             $filesize = $_FILES["cv"]["size"];
            $uploads_dir = __CVSPATH__;
             
            move_uploaded_file($_FILES["cv"]["tmp_name"], $uploads_dir.$_POST['username'].".pdf");
//                echo "Your file was uploaded successfully.";
            
        }
        
    	/*** starting the session ***/
		public function get_session()
		{
	        return $_SESSION['login'];
		}
		
		

		public function edit_data($id,$username,$job,$name,$image_name,$cv_name)
		{
                

			$SQL = $this->db->prepare("UPDATE users SET user_name=?, job=?,name=?,image_name=?,cv_name=? WHERE id=?");
			
			if($SQL)
			{$SQL->bind_param('sssssi',$username,$name,$job,$image_name,$cv_name,$id);
				
			return $SQL->execute();
			}
			return FALSE;

		}
		public static function user_logout()
		{
	        $_SESSION['login'] = FALSE;
			session_destroy();
			if(isset($_COOKIE["user_id"])&&isset($_COOKIE["user_postion"]))
            {
			setcookie('user_postion', '', time() - 3600);
			setcookie('user_id', '', time() - 3600);}
		}
		public  function disconnect()
       {
        if ($this->db) {
            mysqli_close($this->db);
        }
       }

	}
?>
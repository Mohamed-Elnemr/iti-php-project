<?php
//require_once "config.php";

	class User{

		public $db;

		public function __construct(){
			$this->db = new mysqli(__HOST__,__USER__,__PASS__, __DB__);

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
		public function check_login($username,$password){
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
        
    	/*** starting the session ***/
		public function get_session()
		{
	        return $_SESSION['login'];
	    }

		public static function user_logout()
		{
	        $_SESSION['login'] = FALSE;
	        session_destroy();
		}
		public  function disconnect()
       {
        if ($this->db) {
            mysqli_close($this->db);
        }
       }

	}
?>
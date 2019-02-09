

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("autoload.php");
define("_ALLOW_ACCESS", 1);
session_start();
session_regenerate_id();
//Routing
//var_dump($_POST);
// var_dump($_COOKIE);
// $test =new User();
// $x=$test->edite_data(8,"la","la","la","la","la");
// var_dump($x) ;
if(isset($_COOKIE["user_id"])&&isset($_COOKIE["user_postion"]))
{   $_SESSION["user_id"]=$_COOKIE["user_id"];
    $_SESSION["administrator"]=$_COOKIE["user_postion"];
    //echo "remembered";
}
if (isset($_SESSION["user_id"]) && $_SESSION["administrator"] === __ADMIN__) 
{
    //admin views should be required here
    if(isset($_GET["logout"]))
    { User::user_logout();  
      header('Location:index.php');
    }elseif(isset($_GET["UserReport_Export"]))
    {    
        $DB_conection=new MYSQLHandler("users");
        $DB_conection->connect();
        $users=$DB_conection->get_all_data(array("id","user_name","name","job"));
        $DB_conection->export_users_excel($users);
    }elseif(isset($_GET["search"]))
    {    
        require_once ("Views/admin/search.php");
        //die();
    }
    elseif(isset($_GET["id"]) )
    {
        require_once ("Views/admin/user.php");   
    
    }else
    {
        require_once ("Views/admin/users.php");
    }
   
    
} elseif (isset($_SESSION["user_id"]) && $_SESSION["administrator"] === __NORMAL_USER__) 
{
    if(isset($_GET["logout"]))
    { User::user_logout();  
      header('Location:index.php');
    }
    elseif (isset($_GET["edit"])) {
        require_once ("Views/member/edit_my_profile.php");
    
}else{
   require_once ("Views/member/view_my_profile.php");
}


} else 
{
    if(isset($_GET["Create_Account"]))
    { 
        require_once ("Views/public/signup.php");
    }
    else if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $user=new User();
        if($user->check_login($_POST["username"],$_POST["password"],isset($_POST["remember"])? "on" :"off" ))
        {   $user->disconnect();
           header("refresh:0");
        }else
        {  
            $invalid_input_data="Invalid username  or password ";
           require_once ("Views/public/login.php");
         
        }
    }
    else
    {
        require_once ("Views/public/login.php");
    }



   
}
//********************************************//

 //public views should be required here
  // var_dump($_SESSION);
    // if( isset($_SESSION["remember"])&&$_SESSION["remember"]=="on")
    // {               //$_SESSION['password']=$password;
    //    //           $_SESSION['username']=$username;
    //                 $hour = time() + 3600 * 24 * 30;
    //                 setcookie('username', $_SESSION['username'], $hour);
                    
    // }
    

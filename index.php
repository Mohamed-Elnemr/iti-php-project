

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
if (isset($_SESSION["user_id"]) && $_SESSION["administrator"] === "1") 
{
    //admin views should be required here
    if(isset($_GET["logout"]))
    { User::user_logout();  
      header('Location:index.php');
    }
    if(isset($_GET["id"]) && is_numeric($_GET["id"]))
    {
        require_once ("Views/admin/user.php");   
    
    }else
    {
        require_once ("Views/admin/users.php");
    }
    
    
} elseif (isset($_SESSION["user_id"]) && $_SESSION["administrator"] === "0") 
{
    //members views should be required here
    require_once ("Views/member/view_my_profile.php");
   
} else 
{
    if(isset($_GET["Create_Account"]))
    { 
        require_once ("Views/public/signup.php");
    }
    else if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $user=new User();
        if($user->check_login($_POST["username"],$_POST["password"]))
        {   
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
    

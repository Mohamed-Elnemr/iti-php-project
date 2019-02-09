<?php
require_once("autoload.php");
//define("_ALLOW_ACCESS", 1);
error_reporting(0);
session_start();
session_regenerate_id();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "SESSION";
  
    $validator = new Validate();

    
    if (($validator->validateUser($_POST["username"])) == FALSE) {
            echo "inside username </br>";
        $error_register['username'] = "User Name already used";
        
    } elseif (($validator->validatePAssword($_POST['password'], $_POST['confirm_password']) == FALSE)) {
        echo "inside password </br>";


        $error_register['password'] = "Passord must be more than 8 charactres";
        
    } elseif ($validator->validateimage($_FILES['photo']) == FALSE) {
        echo "inside image file </br>";

        $error_register["image"] = "Invalid Image Upload";
        
    } elseif ($validator->validatecv($_FILES['cv']) == FALSE) {
        echo "inside cv file </br>";

        
        $error_register["image"] = "Invalid C.V Upload";
        
    } else {
        $user = new User();
        if($user->reg_user($_POST["username"], $_POST["password"], $_POST["job"], $_POST["name"], $_FILES['photo']['name'], $_FILES['cv']['name'])){
           echo "<h6>user creation<h6>";
            $user->saveImage($_FILES['photo']);
            $user->saveCV($_FILES['cv']);
        }else{
            echo "<h4>error register try again later<h4>";
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Colorlib Templates">
        <meta name="author" content="Colorlib">
        <meta name="keywords" content="Colorlib Templates">

        <!-- Title Page-->
        <title>Apply for job by Colorlib</title>

        <!-- Main CSS-->
        <link href="css/main.css" rel="stylesheet" media="all">
    </head>

    <body>
        <div class="page-wrapper bg-dark p-t-100 p-b-50">
            <div class="wrapper wrapper--w900">
                <div class="card card-6">
                    <div class="card-heading">
                        <h2 class="title">Apply for job</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?Create_Account"; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="name">User Name :</div>
                                <div class="value">
                                    <input class="input--style-6" type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ""; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Full Name:</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-6" type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ""; ?>"required>
                                    </div>
                                </div>
                            </div>
                                <div class="form-row">
                                <div class="name">Your Job :</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-6" type="text" name="job" value="<?php echo isset($_POST['job']) ? $_POST['job'] : ""; ?>"required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Password:</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-6" type="password" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Confirm Password :</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-6" type="password" name="confirm_password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Upload Image</div>
                                <div class="value">
                                    <div class="input-group js-input-file">
                                        <label for="fileSelect">Filename:</label>
                                        <input type="file" name="photo" id="fileSelect" value="<?php echo $_FILES['photo']; ?>">
                                        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="name">Upload CV</div>
                                <div class="value">
                                    <div class="input-group js-input-file">
                                        <label for="fileSelect">Filename:</label>
                                        <input type="file" name="cv" id="fileSelect" value="<?php echo $_FILES['photo']; ?>">
                                        <p><strong>Note:</strong> Only .pdf formats allowed to a max size of 5 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn--radius-2 btn--blue-2" type="submit">Send Application</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

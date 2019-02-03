<html>
     <head>
        <link rel="stylesheet" type="text/css" href="style/style.css">
     <head>
     <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="imgcontainer">
                    <img src="img_avatar2.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <?php echo "<center><span style='color:red;'>".$invalid_input_data."</span></center>"."<br>";?>
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                  

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    
                    <button type="submit">Login</button>
                    <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    
                    <span class="psw">  <a href="<?php echo $_SERVER["PHP_SELF"]."?Create_Account"; ?> ">Create Account </a> </span>
                </div>
        </form>
     <body>
</html>

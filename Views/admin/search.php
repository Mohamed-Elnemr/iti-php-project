<?php
require_once("autoload.php");

$DB_conection=new MYSQLHandler("users");
$DB_conection->connect();

 ?>
<html>
    <head>
        <title>  Search </title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    </head>
    <body>
       <!-- <a href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?> ">logout</a>  
       
       <a href="<?php echo $_SERVER["PHP_SELF"]."?users"; ?> ">Back To Users Page</a>  -->
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link active" href="<?php echo $_SERVER["PHP_SELF"]."?users"; ?>">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo $_SERVER["PHP_SELF"]."?search"; ?>">search</a>
                <a class="nav-item nav-link pull-right" href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?>">logout</a>
                
            </div>
       </nav>

        <form id="Search_form" action='' method="GET" enctype="multipart/form-data" class="search"style="  margin-top: 30px;">
             <label> Search </label>
            <input type="Search" name="search" placeholder="search by job">
            <input id="search" name="search_btn" type="submit" value="search" />
            
        </form>
        
        <div id="result">
            <table >
                <tr>
                    <th>name</th>
                    <th> user name</th>
                    <th>JOB</th> 
                    <th>more info</th>
                 </tr>
                <?php
                   
                    if(!empty($_GET)&& isset($_GET["search_btn"]))
                    {  ///echo var_dump($_POST);
                        $DB_conection=new MYSQLHandler("users");
                        $DB_conection->connect();
                        $fields = array("id","name","user_name","job");
                        $result=$DB_conection->search("job",trim($_GET["search"]),$fields );
                        //echo var_dump($result);
                        //var_dump($result);
                        foreach($result as $record)
                        { echo "<tr>";
                          echo "<td>". $record["name"]."</td>";  
                          echo "<td>". $record["user_name"]."</td>";
                          echo "<td>". $record["job"]."</td>";
                          echo "<td><a href=".$_SERVER["PHP_SELF"]."?id=".$record["id"].">"."more </a>"."</td>";
                         // var_dump($record["id"]);
                          echo "</tr>";    
                        }  
                    
                    } 
                    
                   
                ?>
            </table>
            <!-- <center style=" padding-top:20px;">
            <a href="<?php echo $_SERVER["PHP_SELF"]."?next=".$previous_index; ?>" class="nextprev"> &nbsp;&lt;&nbsp;&lt;&nbsp;  </a>
            <a href="<?php echo $_SERVER["PHP_SELF"]."?next=".$next_index; ?>" class="nextprev">   &nbsp;&nbsp;&gt;&nbsp;&gt;&nbsp; </a>
            </center> -->
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>  
    </body>

</html>

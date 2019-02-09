<?php
$current_index = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
$DB_conection=new MYSQLHandler("users");
$DB_conection->connect();
$items = $DB_conection->get_record_by_id($current_index, 'id');


$user_name=$items[0]["user_name"];
$pdf_name=$user_name.".pdf";
//echo $pdf_name;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
</head>
<body style="margin=0px; padding=0px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="<?php echo $_SERVER["PHP_SELF"]."?users"; ?>">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $_SERVER["PHP_SELF"]."?search"; ?>">search</a>
            <a class="nav-item nav-link" href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?>">logout</a>
            
        </div>
    </nav>
    <div class="profile_side">
        <img src="">
        <h5><?php echo $items[0]["name"];?></h5>
        <h5><?php echo $items[0]["job"];?></h5>
    </div>
    <?php
       
       echo "<embed src='resourses/CVs/".trim($pdf_name)."' type='application/pdf'   height='1150px' width='60%'>"
    ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>    
</body>
</html>
<?php
require_once "autoload.php";

$DB_conection = new MYSQLHandler("users");
$DB_conection->connect();
$items = $DB_conection->get_record_by_id($_SESSION['user_id'], "id");
$user_name = $items[0]["user_name"];
$pdf_name = $user_name . ".pdf";
$imagespath=__IMAGESPATH__;
$cvpath=__CVSPATH__;



?>
<html>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container portfolio">
	<div class="row">
		<div class="col-md-12">
			<div class="heading">	
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                                <a class="nav-item nav-link" href="<?php echo $_SERVER["PHP_SELF"] . "?logout"; ?>">logout</a>
                                <a class="nav-item nav-link" href="<?php echo $_SERVER["PHP_SELF"] . "?edit"; ?>">Edit</a>

                        </form>

			</div>
		</div>	
	</div>
	<div class="bio-info">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="bio-image">
							<img src="<?php echo __IMAGESPATH__.$items[0]['user_name'].".jpg";?>" alt="image" height='350px' width='25%'/>
						</div>			
					</div>
				</div>	
			</div>
			<div class="col-md-6">
				<div class="bio-content">
					<h1>Hi there, I'm <?php echo $items[0]['name'] ;?></h1>
					<h6> I Work As <?php echo $items[0]['job'];?></h6>
                                          <?php  echo "<embed src='__CVSPATH__".trim($pdf_name)."' type='application/pdf'   height='900px' width='65%'>";?>

				</div>
			</div>
		</div>	
	</div>
</div>

</html>





















          

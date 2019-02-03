<?php
require_once("autoload.php");

$DB_conection=new MYSQLHandler("users");
$DB_conection->connect();
$record_count=$DB_conection->get_data_count()[0]["count(*)"];
$current_index = isset($_GET["next"]) && is_numeric($_GET["next"])? (int)$_GET["next"] : 0;
$next_index = $current_index + __RECORDS_PER_PAGE__>=$record_count?$current_index:$current_index + __RECORDS_PER_PAGE__ ;
$previous_index =  ($current_index - __RECORDS_PER_PAGE__ >0) ? $current_index - __RECORDS_PER_PAGE__ : 0 ;

//echo var_dump($result);
?>
<html>
    <head>
        <title>  Search </title>
      <style> 
            table
             {
              width:60%;
              margin: auto;
             }
            table, th, td 
            {
            border: 1px solid black;
            border-collapse: collapse;
            }
            th, td 
            {
            padding: 15px;
            text-align: left;
            }
            table tr:nth-child(even) 
            {
            background-color: #eee;
            }
            table tr:nth-child(odd)
            {
            background-color: #fff;
            }
            table th 
            {
            background-color: black;
            color: white;
            }
            #Search_form{
                margin: auto;
                width:30%;
                margin-bottom: 20px;
            }
            .nextprev
             {
               background-color: #0095B3;
               color: #ffffff;
               text-decoration: none;
               padding:10px;
               font-size: 20px;
               margin: 10px;
               border-radius: 7px;

               
            }
              
</style>
    </head>
    <body>
       <a href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?> ">logout</a>  


        <!-- <form id="Search_form" action='' method="POST" enctype="multipart/form-data">
             <label> Search </label>
            <input type="Search" name="search" placeholder="search by job">
            <input id="search" name="search_btn" type="submit" value="search" />
            
        </form> -->
        
        <div id="result">
            <table >
                <tr>
                    <th>name</th>
                    <th> user name</th>
                    <th>JOB</th> 
                    <th>more info</th>
                 </tr>
                <?php
                    //<?php echo $_SERVER["PHP_SELF"]; 
                    // if(!empty($_POST)&& $_POST["search_btn"]==="search")
                    // {  ///echo var_dump($_POST);
                    //     $DB_conection=new MYSQLHandler("users");
                    //     $DB_conection->connect();
                    //     $fields = array("name","user_name","job");
                    //     $result=$DB_conection->search("job",trim($_POST["search"]),$fields );
                    //     //echo var_dump($result);
                    //     //var_dump($result);
                    //     foreach($result as $record)
                    //     { echo "<tr>";
                    //         foreach($record as $col=>$value)
                    //         {   echo "<td>".$value."</td>";
                    //         }
                    //      echo " <td>more info</td>";
                    //       echo "</tr>";    
                    //     }  
                    
                    // } else
                    // {  $DB_conection=new MYSQLHandler("users");
                        $DB_conection->connect();
                        $fields =array("id","name","user_name","job");
                        $result=$DB_conection->get_data($fields,$current_index);;
                      //  var_dump($result."else");
                        foreach($result as $record)
                        { echo "<tr>";
                          echo "<td>". $record["name"]."</td>";  
                          echo "<td>". $record["user_name"]."</td>";
                          echo "<td>". $record["job"]."</td>";
                          echo "<td><a href=".$_SERVER["PHP_SELF"]."?id=".$record["id"].">"."more </a>"."</td>";
                         // var_dump($record["id"]);
                          echo "</tr>";    
                        }  
                    
                   // }   
                ?>
            </table>
            <center style=" padding-top:20px;">
            <a href="<?php echo $_SERVER["PHP_SELF"]."?next=".$previous_index; ?>" class="nextprev"> &nbsp;&lt;&nbsp;&lt;&nbsp;  </a>
            <a href="<?php echo $_SERVER["PHP_SELF"]."?next=".$next_index; ?>" class="nextprev">   &nbsp;&nbsp;&gt;&nbsp;&gt;&nbsp; </a>
            </center>
        </div>
    </body>

</html>

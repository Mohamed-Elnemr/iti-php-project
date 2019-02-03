<?php
$current_index = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
$DB_conection=new MYSQLHandler("users");
$DB_conection->connect();
$items = $DB_conection->get_record_by_id($current_index, 'id');
var_dump($items)
?>
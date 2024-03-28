<?php

 $con = new mysqli('localhost', 'root', '','crud_operation');

 if(!$con){
    die("Connection failed: " . mysqli_connect_error($con));
 }

?>

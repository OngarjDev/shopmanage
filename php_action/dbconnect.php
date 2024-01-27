<?php

$con = new mysqli('localhost:3306','root','root','dbshop');

if($con->connect_error){
    die("Server config ERROR (check config in server)" . $con->connect_error);
}

?>
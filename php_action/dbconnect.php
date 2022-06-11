<?php

$con = new mysqli('localhost','root','root','dbshop');

if($con->connect_error){
    die("Server config ERROR (check config in server)" . $con->connect_error);
}

?>
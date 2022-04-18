<?php

$con = new mysqli('us-cdbr-east-05.cleardb.net','b0f6f00b2326a0','053e77f1','heroku_4bd1ea5013e83e0');

if($con->connect_error){
    die("Server config ERROR (check config in server)" . $con->connect_error);
}

?>
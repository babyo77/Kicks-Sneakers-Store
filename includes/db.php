<?php
 $host = 'localhost'; 
 $dbname = 'users';
 $dbusername = 'root';
 $dbpassword = '';

 $con = new mysqli($host,$dbusername,$dbpassword,$dbname);

 if($con->connect_error){
    die('connection failed '. mysqli_connect_error());
 }
?>
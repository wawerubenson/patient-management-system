
<?php

session_start();

define('ROOT_URL','http://localhost/pms/');

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

$dbconnection = mysqli_connect($servername, $dbusername, $dbpassword);

mysqli_select_db($dbconnection, 'pmsdb');

if(!$dbconnection) {
    die("could not connect to database");
}
 ?>
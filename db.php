<?php
$db_host = "localhost";
$db_user = "root";
$db_pwd = "";
$db_name = "studenttracker_iiec2026";
//connect ke database
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
if(!$conn) {
    die("database connection failed : " . mysqli_connect_error());
}
?>
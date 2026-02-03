<?php
session_start();
include("db.php");

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$subject = $_POST['subject'];
$duration = $_POST['duration'];

mysqli_query($conn,"INSERT INTO study_session(user_id,title,subject,duration)
VALUES($user_id,'$title','$subject',$duration)");
?>

<?php
include("db.php");
session_start();

$id=$_SESSION['user_id'];
$subject=$_POST['subject'];
$duration=$_POST['duration'];
$today=date("Y-m-d");

mysqli_query($conn,
"INSERT INTO study_session(user_id,subject,duration,session_date)
VALUES($id,'$subject',$duration,'$today')");

$s=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM streak WHERE user_id=$id"));

if($s['last_session_date']==date("Y-m-d",strtotime("-1 day"))){
    $current=$s['current_streak']+1;
}else if($s['last_session_date']!=$today){
    $current=1;
}else{
    $current=$s['current_streak'];
}

$longest=max($current,$s['longest_streak']);

mysqli_query($conn,
"UPDATE streak SET current_streak=$current,longest_streak=$longest,last_session_date='$today' WHERE user_id=$id");

header("Location:dashboard.php");
?>
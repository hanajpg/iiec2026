<?php
session_start();
include("db.php");
if(!isset($_SESSION['user_id'])) exit("No session");

$user_id = $_SESSION['user_id'];
$title = mysqli_real_escape_string($conn,$_POST['title']);
$subject = mysqli_real_escape_string($conn,$_POST['subject']);
$duration = (int)$_POST['duration'];
$today = date('Y-m-d');

// insert session
mysqli_query($conn,"INSERT INTO study_session(user_id,title,subject,duration,session_date)
VALUES($user_id,'$title','$subject',$duration,'$today')");

// fetch streak
$streak = mysqli_fetch_assoc(mysqli_query($conn,"SELECT current_streak,longest_streak,last_study_date FROM streak WHERE user_id=$user_id"));
$current_streak = (int)$streak['current_streak'];
$longest_streak = (int)$streak['longest_streak'];
$last_date = $streak['last_study_date'];

if($last_date == $today){
    $new_streak = $current_streak; // already studied today
}
elseif($last_date == date('Y-m-d', strtotime('-1 day'))){
    $new_streak = $current_streak + 1; // continued streak
}
else{
    $new_streak = 1; // broke streak
}

$new_longest = max($longest_streak, $new_streak);

mysqli_query($conn,"UPDATE streak SET current_streak=$new_streak, longest_streak=$new_longest, last_study_date='$today' WHERE user_id=$user_id");
?>

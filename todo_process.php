<?php
include("db.php");
session_start();
$id=$_SESSION['user_id'];

if(isset($_POST['task'])){
    mysqli_query($conn,
    "INSERT INTO todo_list(user_id,task) VALUES($id,'$_POST[task]')");
}

if(isset($_GET['done'])){
    mysqli_query($conn,
    "UPDATE todo_list SET is_done=1 WHERE id=$_GET[done]");
}

header("Location:todo.php");
?>

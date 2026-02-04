<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])) exit();

$action = $_POST['action'] ?? '';

if($action == 'start'){
    $_SESSION['session_start'] = time();
} 
elseif($action == 'stop'){
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $duration = intval($_POST['duration'] ?? 0); // in seconds

    // Escape strings
    $title = mysqli_real_escape_string($conn, $title);
    $subject = mysqli_real_escape_string($conn, $subject);

    // Save to database
    $query = "INSERT INTO study_session(user_id, title, subject, duration)
              VALUES($user_id, '$title', '$subject', $duration)";

    if(mysqli_query($conn, $query)){
        unset($_SESSION['session_start']); // clear timer
        echo "<script>
                alert('Session saved. Going back to dashboard...');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to save session. Please try again.');
                window.history.back();
              </script>";
    }
}
?>
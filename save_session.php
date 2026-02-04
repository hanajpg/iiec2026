<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_POST['action'] ?? '';

    if($action == 'start'){
        $_SESSION['session_start'] = time();
    } 
    elseif($action == 'stop'){
        $title = $_POST['title'] ?? 'No title';
        $subject = $_POST['subject'] ?? 'No subject';
        $duration = $_POST['duration'] ?? '0h 0m';

        // Simpan ke database
        // contoh: saveSession($title, $subject, $duration);

        unset($_SESSION['session_start']); // clear session
    }
}
?>

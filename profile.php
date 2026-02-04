<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// Total study time in seconds
$time = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(duration) AS total FROM study_session WHERE user_id=$uid"));

// User info
$user = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT username, nickname, bio FROM users WHERE id=$uid"));

// Study sessions
$sessions = mysqli_query($conn,
"SELECT subject, title, duration, session_date 
 FROM study_session 
 WHERE user_id=$uid 
 ORDER BY session_date DESC");

$total_sec = $time['total'] ?? 0;
$total_hours = floor($total_sec / 3600);
$total_minutes = floor(($total_sec % 3600) / 60);
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="profile.css">
</head>
<body>

<a href="dashboard.php" class="dash-float">🏠 Dashboard</a>

<div class="profile-page">

    <div class="streak-orb">
        <div class="flame">🔥</div>
        <h1><?= $total_hours ?>h <?= $total_minutes ?>m</h1>
        <span>Total Study Time</span>
    </div>

    <div class="user-card">
        <h2><?= $user['nickname'] ?: $user['username'] ?></h2>
        <p><?= $user['bio'] ?: "Trying to stay consistent every day 🌱" ?></p>
    </div>

    <div class="record-card">
        <h3>Study History</h3>

        <?php while($row = mysqli_fetch_assoc($sessions)){ 
            $sec = $row['duration'] ?? 0;
            $h = floor($sec/3600);
            $m = floor(($sec%3600)/60);
        ?>
        <div class="record-item">
            <div>
                <b><?= $row['subject'] ?></b>
                <small><?= $row['title'] ?></small>
            </div>
            <div class="record-right">
                <span><?= $h ?>h <?= $m ?>m</span>
                <small><?= $row['session_date'] ?></small>
            </div>
        </div>
        <?php } ?>

    </div>

</div>

</body>
</html>
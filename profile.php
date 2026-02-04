<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

$time = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(duration) AS total FROM study_session WHERE user_id=$uid"));

$user = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT username, nickname, bio FROM users WHERE id=$uid"));

$sessions = mysqli_query($conn,
"SELECT subject, title, duration, session_date 
 FROM study_session 
 WHERE user_id=$uid 
 ORDER BY session_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="profile.css">
</head>
<body>

<!-- FLOATING DASHBOARD BUTTON -->
<a href="dashboard.php" class="dash-float">🏠 Dashboard</a>

<div class="profile-page">

    <!-- FIRE STREAK CENTER -->
    <div class="streak-orb">
        <div class="flame">🔥</div>
        <h1><?= round($time['total']/60) ?></h1>
        <span>minutes studied</span>
    </div>

    <!-- USER CARD -->
    <div class="user-card">
        <h2><?= $user['nickname'] ?: $user['username'] ?></h2>
        <p><?= $user['bio'] ?: "Trying to stay consistent every day 🌱" ?></p>
    </div>

    <!-- RECORD CARD -->
    <div class="record-card">
        <h3>Study History</h3>

        <?php while($row=mysqli_fetch_assoc($sessions)){ ?>
        <div class="record-item">
            <div>
                <b><?= $row['subject'] ?></b>
                <small><?= $row['title'] ?></small>
            </div>
            <div class="record-right">
                <span><?= round($row['duration']/60) ?> min</span>
                <small><?= $row['session_date'] ?></small>
            </div>
        </div>
        <?php } ?>

    </div>

</div>

</body>
</html>



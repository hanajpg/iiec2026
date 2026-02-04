<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// total minutes studied
$time = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(duration) AS total FROM study_session WHERE user_id=$uid"));

// streak
$streak_data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT current_streak FROM streak WHERE user_id=$uid"));
$current_streak = (int)$streak_data['current_streak'];

// user info
$user = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT username, nickname, bio FROM users WHERE id=$uid"));

// sessions
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
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="dashboard.php" class="dash-float">🏠 Dashboard</a>

<div class="profile-page">

    <div class="streak-orb">
        <div class="flame">🔥</div>
        <h1><?= $current_streak ?></h1>
        <span><?= $current_streak ?> day<?= $current_streak>1?'s':'' ?> streak</span>
    </div>

    <div class="user-card">
        <h2><?= $user['nickname'] ?: $user['username'] ?></h2>
        <p><?= $user['bio'] ?: "Trying to stay consistent every day 🌱" ?></p>
    </div>

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
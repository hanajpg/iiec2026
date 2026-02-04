<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// total study time
$time = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(duration) AS total FROM study_session WHERE user_id=$uid"));

// ambil profile user
$user = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT username, nickname, bio FROM users WHERE id=$uid"));

// ambil rekod study
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

<a href="dashboard.php" class="dashboard-btn">🏠 Dashboard</a>

<div class="profile-container">

    <!-- 🔥 STREAK / TOTAL STUDY -->
    <div class="streak-card">
        <div class="fire">🔥</div>
        <h2><?= round($time['total']/60) ?> minutes studied</h2>
        <p>Keep the streak alive 🌱</p>
    </div>

    <!-- 👤 PROFILE INFO -->
    <div class="profile-card">
        <h3><?= $user['nickname'] ?: $user['username'] ?></h3>
        <p class="bio"><?= $user['bio'] ?: "No bio yet 🌿" ?></p>
    </div>

    <!-- 📚 STUDY HISTORY -->
    <div class="history-card">
        <h3>Study Records</h3>

        <table>
            <tr>
                <th>Date</th>
                <th>Subject</th>
                <th>Note</th>
                <th>Duration</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($sessions)){ ?>
            <tr>
                <td><?= $row['session_date'] ?></td>
                <td><?= $row['subject'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= round($row['duration']/60) ?> min</td>
            </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>


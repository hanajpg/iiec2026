<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="blob"></div>

<div class="container">
    <div class="card" style="max-width:600px;">
        <h1>Hi, <?=$_SESSION['nickname']?> 🌿</h1>
        <p>Choose where you want to grow today.</p>

        <a href="tracker.php"><button class="btn btn-primary">⏱ Study Tracker</button></a>
        <a href="todo.php"><button class="btn btn-outline">📝 To-Do List</button></a>
        <a href="profile.php"><button class="btn btn-outline">🔥 Profile & Streak</button></a>
        <a href="leaderboard.php"><button class="btn btn-outline">🏆 Leaderboard</button></a>
        <a href="logout.php"><button class="btn btn-outline">Logout</button></a>
    </div>
</div>

</body>
</html>

<?php
session_start();
include("db.php");
$uid=$_SESSION['user_id'];

$time=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(duration) total FROM study_session WHERE user_id=$uid"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="dashboard.php" class="dashboard-btn">
    <span class="dash-icon">🏠</span>
    <span class="dash-text">Dashboard</span>
</a>

<div class="container">
<div class="card">
<h1>🔥 Your Growth</h1>
<p>Total study time: <?=round($time['total']/60)?> minutes</p>
</div>
</div>

</body>
</html>

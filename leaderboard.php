<?php
include("db.php");
$data=mysqli_query($conn,"
SELECT users.nickname, SUM(study_session.duration) total
FROM study_session JOIN users ON users.id=study_session.user_id
GROUP BY users.id ORDER BY total DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="dashboard.php" class="dashboard-btn">
    <span class="dash-icon">🏠</span>
    <span class="dash-text">Dashboard</span>
</a>
<div class="container">
<div class="card">
<h1>🏆 Leaderboard</h1>
<?php while($u=mysqli_fetch_assoc($data)): ?>
<p><?=$u['nickname']?> — <?=round($u['total']/60)?> mins</p>
<?php endwhile; ?>
</div>
</div>

</body>
</html>
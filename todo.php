<?php
session_start();
include("db.php");
$user_id=$_SESSION['user_id'];

if(isset($_POST['task'])){
    mysqli_query($conn,"INSERT INTO todo_list(user_id,task) VALUES($user_id,'".$_POST['task']."')");
}

if(isset($_GET['done'])){
    mysqli_query($conn,"UPDATE todo_list SET is_done=1 WHERE id=".$_GET['done']);
}

if(isset($_GET['del'])){
    mysqli_query($conn,"DELETE FROM todo_list WHERE id=".$_GET['del']);
}

$data=mysqli_query($conn,"SELECT * FROM todo_list WHERE user_id=$user_id");
?>
<!DOCTYPE html>
<html>
<head>
<title>To Do</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="dashboard.php" class="dashboard-btn">
    <span class="dash-icon">🏠</span>
    <span class="dash-text">Dashboard</span>
</a>

<div class="container">
<div class="card">
<h1>📝 To Do</h1>

<form method="POST">
<input class="input" name="task" placeholder="New task">
<button class="btn btn-primary">Add</button>
</form>

<?php while($t=mysqli_fetch_assoc($data)): ?>
<p>
<?=$t['task']?>
<?php if(!$t['is_done']): ?>
<a href="?done=<?=$t['id']?>">✅</a>
<?php endif; ?>
<a href="?del=<?=$t['id']?>">🗑</a>
</p>
<?php endwhile; ?>

</div>
</div>

</body>
</html>
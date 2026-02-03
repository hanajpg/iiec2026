<?php
session_start();
include("db.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nickname'] = $user['nickname'];

        header("Location: dashboard.php");
        exit();
    }
}

echo "
<script>
    alert('Invalid username or password ❌');
    window.location.href='login.php';
</script>
";
?>
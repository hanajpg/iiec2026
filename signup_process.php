<?php
include("db.php");

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nickname = $_POST['nickname'];
$bio = $_POST['bio'];

$sql = "INSERT INTO users (username, password, nickname, bio)
        VALUES ('$username', '$password', '$nickname', '$bio')";

if (mysqli_query($conn, $sql)) {

    $user_id = mysqli_insert_id($conn);

    // create streak record
    mysqli_query($conn,
        "INSERT INTO streak (user_id, current_streak, longest_streak)
         VALUES ($user_id, 0, 0)"
    );

    echo "
    <script>
        alert('Account created! Let’s login 🌿');
        window.location.href='login.php';
    </script>
    ";

} else {
    echo "Error: " . mysqli_error($conn);
}
?>

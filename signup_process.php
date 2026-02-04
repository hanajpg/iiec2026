<?php
include("db.php");

// ambil data dari form
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
$bio = mysqli_real_escape_string($conn, $_POST['bio']);

// check username exist
$check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
if(mysqli_num_rows($check) > 0){
    echo "
    <script>
        alert('Username already taken! Please choose another 🌿');
        window.location.href='signup.php';
    </script>
    ";
    exit();
}

// insert user
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
    echo "
    <script>
        alert('Error: ".mysqli_real_escape_string($conn, mysqli_error($conn))."');
        window.location.href='signup.php';
    </script>
    ";
}
?>
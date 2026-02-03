<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="blob"></div>

<div class="container">
    <div class="card">
        <h1>🌱 Join Study Journal</h1>
        <p>Create your calm study space</p>

        <form action="signup_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="nickname" placeholder="Nickname">
            <textarea name="bio" placeholder="Short bio (optional)"></textarea>

            <button class="btn btn-primary" type="submit">Create Account</button>
        </form>

        <p style="margin-top:15px;">
            Already have an account? <a href="login.php">Login</a>
        </p>
    </div>
</div>

</body>
</html>

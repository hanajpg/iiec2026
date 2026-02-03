<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="blob"></div>

<div class="container">
    <div class="card">
        <h1>🌿 Welcome Back</h1>
        <p>Let’s continue your journey</p>

        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button class="btn btn-primary" type="submit">Login</button>
        </form>

        <p style="margin-top:15px;">
            New here? <a href="signup.php">Create account</a>
        </p>
    </div>
</div>

</body>
</html>
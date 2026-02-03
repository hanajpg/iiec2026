<?php
session_start();
?>

<header style="background: linear-gradient(90deg, #FFB6C1, #FFC1E3);
    padding: 15px 20px;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
">
    <h1 style="
        font-family: 'Poppins', sans-serif;
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 24px;
        display: flex;
        align-items: center;
        gap: 8px;">Student Tracker Journal</h1>
    <nav  style="display:flex; gap:15px;">
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php" style="color:white; font-weight:600; transition:0.3s;">Dashboard</a>
            <a href="tracker.php" style="color:white; font-weight:600; transition:0.3s;">Tracker</a>
            <a href="todo.php" style="color:white; font-weight:600; transition:0.3s;"> To-Do</a>
            <a href="leaderboard.php" style="color:white; font-weight:600; transition:0.3s;"> Leaderboard</a>
            <a href="quotes.php" style="color:white; font-weight:600; transition:0.3s;"> Quotes</a>
    </nav>
        <?php else: ?>
            <a href="login.php" style="color:white; font-weight:600; transition:0.3s;"> Log In</a> |
            <a href="signup.php"style="color:white; font-weight:600; transition:0.3s;"> Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

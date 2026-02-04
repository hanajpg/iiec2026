<?php
session_start();
if(!isset($_SESSION['user_id'])) exit();
?>
<!DOCTYPE html>
<html>
<head>
<title>Study Tracker</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="dashboard.php" class="dashboard-btn">
    <span class="dash-icon">🏠</span>
    <span class="dash-text">Dashboard</span>
</a>

<div class="container">
<div class="card">
<h1>⏱ Study Session</h1>

<div id="timer" style="font-size:40px;">00:00:00</div>

<input class="input" id="title" placeholder="Session title">
<input class="input" id="subject" placeholder="Subject">

<button class="btn btn-primary" onclick="start()">Start</button>
<button class="btn btn-outline" onclick="stop()">Stop & Save</button>

</div>
</div>

<script>
let timer, running = false;

function updateTimerDisplay(sec){
    let h = Math.floor(sec / 3600);
    let m = Math.floor((sec % 3600) / 60);
    let s = sec % 60;
    document.getElementById("timer").innerText = 
        `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
}

// Start session
function start(){
    if(!running){
        running = true;

        // Inform server that session started
        fetch("save_session.php", {
            method: "POST",
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: "action=start"
        });

        timer = setInterval(()=>{
            fetch("get_elapsed.php")
            .then(res => res.json())
            .then(data => {
                updateTimerDisplay(data.elapsed);
            });
        }, 1000);
    }
}

// Stop & Save session
function stop(){
    running = false;
    clearInterval(timer);

    // Get final elapsed from server
    fetch("get_elapsed.php")
    .then(res => res.json())
    .then(data => {
        let sec = data.elapsed;
        let hours = Math.floor(sec / 3600);
        let minutes = Math.floor((sec % 3600) / 60);
        let duration = `${hours}h ${minutes}m`;

        fetch("save_session.php", {
            method: "POST",
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `title=${encodeURIComponent(title.value)}&subject=${encodeURIComponent(subject.value)}&duration=${duration}&action=stop`
        })
        .then(()=> {
            // Redirect to dashboard after saving
            window.location.href = "dashboard.php";
        });
    });
}

// Load current elapsed on page load
window.onload = function(){
    fetch("get_elapsed.php")
    .then(res => res.json())
    .then(data => {
        if(data.elapsed > 0){
            running = true;
            updateTimerDisplay(data.elapsed);
            timer = setInterval(()=>{
                fetch("get_elapsed.php")
                .then(res => res.json())
                .then(data => updateTimerDisplay(data.elapsed));
            },1000);
        }
    });
}
</script>

</body>
</html>

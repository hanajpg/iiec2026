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
let sec=0, timer, running=false;

function start(){
    if(!running){
        running=true;
        timer=setInterval(()=>{
            sec++;
            let h=Math.floor(sec/3600);
            let m=Math.floor((sec%3600)/60);
            let s=sec%60;
            document.getElementById("timer").innerText=
            `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        },1000);
    }
}

function stop(){
    clearInterval(timer);
    running=false;

    fetch("save_session.php",{
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`title=${title.value}&subject=${subject.value}&duration=${sec}`
    }).then(()=>alert("Session saved 🌿"));
}
</script>

</body>
</html>

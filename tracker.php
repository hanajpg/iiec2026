<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Study Tracker</title>
<link rel="stylesheet" href="style.css">
<style>
.container .card{
    max-width:600px;
    margin:auto;
    padding:40px;
    border-radius:30px;
    background:rgba(255,255,255,0.35);
    backdrop-filter:blur(18px);
    box-shadow:0 25px 60px rgba(0,0,0,0.15);
}

.container .card h1{
    text-align:center;
    font-size:36px;
    margin-bottom:25px;
}

.input, button{
    width:100%;
    padding:16px 20px;
    border-radius:25px;
    font-size:16px;
    margin-top:12px;
    border:none;
    outline:none;
}

button{
    background:linear-gradient(135deg,#5fd3a4,#2bb673);
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}
button:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(43,182,115,0.4);
}

.dashboard-btn{
    position:fixed;
    top:20px;
    left:20px;
    padding:12px 22px;
    background:rgba(255,255,255,.75);
    border-radius:50px;
    text-decoration:none;
    color:#2e7d32;
    font-weight:600;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    backdrop-filter:blur(10px);
    transition:.3s;
}
.dashboard-btn:hover{
    transform:scale(1.05);
    background:#e8f5e9;
}
</style>
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

<button onclick="start()">Start</button>
<button onclick="stop()">Stop & Save</button>
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

    const title = document.getElementById('title').value.trim();
    const subject = document.getElementById('subject').value.trim();

    if(title=="" || subject==""){
        alert("Please fill title & subject 🌿");
        return;
    }

    fetch("save_session.php",{
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`title=${encodeURIComponent(title)}&subject=${encodeURIComponent(subject)}&duration=${sec}`
    })
    .then(res=>res.text())
    .then(data=>{
        alert("Session saved 🌿 Going back to dashboard!");
        window.location.href="dashboard.php";
    })
    .catch(err=>{
        alert("Oops! Something went wrong.");
        console.error(err);
    });
}
</script>

</body>
</html>

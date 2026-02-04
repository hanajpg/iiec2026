<?php
session_start();
$elapsed = 0;
if(isset($_SESSION['session_start'])){
    $elapsed = time() - $_SESSION['session_start'];
}
echo json_encode(['elapsed' => $elapsed]);
?>

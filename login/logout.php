<?php
    session_start();
    session_destroy();
    $Username = $_GET['Username'];
    echo "User : " . $Username . " now logout.";
    echo "<br><a href='login.php'>คลิก กลับไปหน้า login </a>"
?>
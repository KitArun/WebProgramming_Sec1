<?php
session_start();
session_destroy();
?>
<form action="session_file2.php">
    กรุณาป้อนชื่อผู้ใช้ (username)<br>
    <input type="text" name="username"> <br>
    กรุณาป้อนรหัสผ่านผู้ใช้ (password)<br>
    <input type="text" name="password"> <br>
    แล้วคลิกปุ่ม OK
    <input type="submit" value=" OK ">
</form>
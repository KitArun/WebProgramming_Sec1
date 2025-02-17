<?php
session_start();
session_destroy();
?>
<form action="checkUser.php" method="post">
    <table border='1' width='300'>
        <tr>
            <td colspan='2' align='center'>กรุณาป้อนชื่อผู้ใช้งานและรหัสผ่าน</td>
        </tr>
        <tr>
            <td>Username :</td>
            <td><input type="text" name="Username"></td>
            </td>
        <tr>
            <td>Password :</td>
            <td><input type="password" name="Password"></td>
            </td>
        <tr>
            <td colspan='2' align='center'><input type="submit" value=" OK "></td>
        </tr>
    </table>
</form>
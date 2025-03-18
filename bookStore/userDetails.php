<?php
session_start();
$Username = $_GET['Username'];

if ($Username == $_SESSION['Username']) {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";
    $conn = mysqli_connect($hostname, $username, $password);
    if (!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");

    mysqli_select_db($conn, $dbname) or die("ไม่สามารถเลือกฐานข้อมูล bookStore ได้");

    $sqltxt = "SELECT * FROM login WHERE username = '$Username'";
    $result = mysqli_query($conn, $sqltxt);
    $rs = mysqli_fetch_array($result);

    echo "<table border=1 align=center bgcolor=#FFCCCC width=400>";
    echo "<tr><td colspan=2 bgcolor=#FF99CC><B>แสดงรายละเอียดผู้ใช้</B></td></tr>";
    echo "<tr><td> Username : </td><td>" . $rs["username"] . "</td></tr>";
    echo "<tr><td> Password : </td><td>" . $rs["password"] . "</td></tr>";
    echo "<tr><td> Status : </td><td>" . $rs["status"] . "</td></tr>";
    echo "</table>";

    echo "<br><a href='logout.php?Username=$Username'> logout </a>";
} else {
    echo "คุณยังไม่ได้ล็อกอิน";
    echo "<br><a href='login.php'>คลิกที่นี่เพื่อเข้าสู่ระบบ</a>";
}
?>

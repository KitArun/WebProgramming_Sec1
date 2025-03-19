<?php
$servername = "localhost";  // ถ้าใช้ XAMPP ให้ใช้ localhost
$username = "root";         // ค่าเริ่มต้นของ XAMPP คือ root
$password = "";             // ค่าเริ่มต้นของ XAMPP คือไม่มีรหัสผ่าน
$dbname = "gt4speedteam";     // ชื่อฐานข้อมูล (เปลี่ยนตามที่คุณตั้งไว้)

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

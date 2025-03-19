<?php
session_start(); // เริ่มต้นเซสชันเพื่อจัดการการล็อกอิน
if (!isset($_SESSION['Username'])) {
    // ถ้าผู้ใช้ยังไม่ได้ล็อกอิน ให้แสดงข้อความและลิงค์ไปยังหน้า login
    echo "คุณยังไม่ได้ล็อกอิน";
    echo "<br><a href='login.php'>คลิกที่นี่เพื่อเข้าสู่ระบบ</a>";
    exit;
}

// รับค่าชื่อผู้ใช้จากเซสชัน
$Username = $_SESSION['Username'];

$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "bookStore";

// เชื่อมต่อฐานข้อมูล MySQL
$conn = mysqli_connect($hostname, $username, $password);
if (!$conn) 
    die("ไม่สามารถติดต่อกับ MySQL ได้");

// เลือกฐานข้อมูล
mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล bookStore ได้");

// กำหนดการเข้ารหัสเป็น utf8mb4 เพื่อรองรับตัวอักษรพิเศษ
mysqli_query($conn, "set character_set_connection=utf8mb4");
mysqli_query($conn, "set character_set_client=utf8mb4");
mysqli_query($conn, "set character_set_results=utf8mb4");

// ดึงข้อมูลหนังสือจากฐานข้อมูล
$sql = "SELECT * FROM book ORDER BY bookId";
$result = mysqli_query($conn, $sql);

echo '<center>';
echo '<br><h3>รายชื่อหนังสือ</h3>';
echo '<table width="500" border="0">';
echo '<tr><td align="left"><a href="bookInsert1.php">เพิ่มรายการหนังสือ</a></td></tr>';
echo '</table>';
echo '<br><table width="500" border="1">';
echo '<tr>';
echo '<th width ="50">ลำดับ</th>';
echo '<th width ="100">รหัสหนังสือ</th>';
echo '<th width="200">ชื่อหนังสือ</th>';
echo '<th width ="80">แก้ไข</th>';
echo '<th width ="80">ลบ</th>';
echo '</tr>';

$row = 1;
while ($rs = mysqli_fetch_array($result)) {
    echo '<tr align="center">';
    echo '<td>' . $row . '</td>';
    echo '<td><a href="bookDetail.php?bookId=' . $rs[0] . '">' . $rs[0] . '</a></td>';
    echo '<td align="left">' . $rs[1] . '</td>';
    echo '<td><a href="bookUpdate1.php?bookId=' . $rs[0] . '">[แก้ไข]</a></td>';
    echo '<td><a href="bookDelete1.php?bookId=' . $rs[0] . '" onclick="return confirm(\'ยืนยันการลบข้อมูลหนังสือ ' . $rs[1] . '\')">[ลบ]</a></td>';
    echo '</tr>';
    $row++;
}

echo '</table>';
mysqli_close($conn);

// เพิ่มลิงค์ไปยังหน้ารายละเอียดผู้ใช้ที่จะแสดงข้อมูลของผู้ใช้ที่ล็อกอินอยู่
echo '<br><a href="userDetails.php?Username=' . $Username . '">ไปยังหน้ารายละเอียดผู้ใช้</a>';

echo '<br><br><a href="menu1.php">กลับสู่เมนู</a>';
echo '</center>';
?>

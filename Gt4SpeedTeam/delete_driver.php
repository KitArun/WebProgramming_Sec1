<?php
include 'config.php';

if (isset($_GET['id'])) {
    $driver_id = $_GET['id'];  // ใช้ driver_id แทน id
    $sql = "DELETE FROM drivers WHERE driver_id = ?";  // ใช้ driver_id ใน WHERE clause

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $driver_id);  // ผูก parameter (i = integer)
        if ($stmt->execute()) {
            echo "ลบสำเร็จ!";
        } else {
            echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
    }
}

header("Location: list_drivers.php");  // หลังจากลบเสร็จจะกลับไปที่หน้ารายชื่อ
?>

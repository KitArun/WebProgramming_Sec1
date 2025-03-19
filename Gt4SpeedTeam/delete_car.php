<?php
include 'config.php';

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $sql = "DELETE FROM cars WHERE car_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $car_id);  // ผูก parameter (i = integer)
        if ($stmt->execute()) {
            echo "ลบรถแข่งสำเร็จ!";
        } else {
            echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
    }
}

header("Location: list_cars.php");  // หลังจากลบเสร็จจะกลับไปที่หน้ารายชื่อรถ
?>
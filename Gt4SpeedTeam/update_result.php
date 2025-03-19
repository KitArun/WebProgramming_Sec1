<?php
include 'config.php';

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result_id = $_POST["result_id"];
    $position = $_POST["position"];
    $best_time = $_POST["best_time"];

    // ใช้ prepare statement เพื่อป้องกัน SQL Injection
    $sql = "UPDATE results SET position = ?, best_time = ? WHERE result_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Binding parameters
        $stmt->bind_param("ssi", $position, $best_time, $result_id);
        
        if ($stmt->execute()) {
            // ถ้าอัปเดตสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการผลการแข่งขัน
            echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='list_results.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: ไม่สามารถเตรียมคำสั่ง SQL ได้";
    }
}

$conn->close();
?>

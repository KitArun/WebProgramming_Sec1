<?php
include 'config.php';

if (isset($_GET['id'])) {
    $race_id = $_GET['id'];

    $sql = "DELETE FROM races WHERE race_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $race_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('ลบข้อมูลสนามแข่งเรียบร้อย!'); window.location='list_races.php';</script>";
        } else {
            echo "เกิดข้อผิดพลาดในการลบ: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }
} else {
    echo "ไม่มี ID ของสนามแข่งที่ต้องการลบ";
}
?>

<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $race_id = $_POST['race_id'];
    $race_name = $_POST['race_name'];
    $circuit = $_POST['circuit'];
    $lap_count = $_POST['lap_count'];
    $race_date = $_POST['race_date'];

    $sql = "UPDATE races SET race_name = ?, circuit = ?, lap_count = ?, race_date = ? WHERE race_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssisi", $race_name, $circuit, $lap_count, $race_date, $race_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('อัปเดตข้อมูลสนามแข่งเรียบร้อย!'); window.location='list_races.php';</script>";
        } else {
            echo "เกิดข้อผิดพลาดในการอัปเดต: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }
}
?>

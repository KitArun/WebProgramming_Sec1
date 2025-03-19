<?php
include 'config.php';

// กำหนดอาร์เรย์สำหรับเก็บข้อความข้อผิดพลาด
$errors = [];

// ตรวจสอบว่ามีข้อมูลที่ส่งมาจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่าฟิลด์ที่จำเป็นทั้งหมดถูกกรอกหรือไม่
    $required_fields = ['driver_id', 'name', 'nationality', 'join_year', 'experience_years', 'team_id'];
    foreach ($required_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = "กรุณากรอกข้อมูลในฟิลด์ '$field' ให้ครบถ้วน";
        }
    }

    // ถ้าไม่มีข้อผิดพลาด
    if (empty($errors)) {
        // รับค่าจากฟอร์ม
        $driver_id = $_POST['driver_id'];
        $name = $_POST['name'];
        $nationality = $_POST['nationality'];
        $join_year = $_POST['join_year'];
        $experience_years = $_POST['experience_years'];
        $team_id = $_POST['team_id'];

        // คำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE drivers SET name = ?, nationality = ?, join_year = ?, experience_years = ?, team_id = ? WHERE driver_id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // ผูกตัวแปรกับคำสั่ง SQL
            $stmt->bind_param("sssiii", $name, $nationality, $join_year, $experience_years, $team_id, $driver_id);

            // ถ้าอัปเดตสำเร็จ
            if ($stmt->execute()) {
                echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='list_drivers.php';</script>";
            } else {
                $errors[] = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $stmt->error;
            }

            // ปิดคำสั่ง
            $stmt->close();
        } else {
            $errors[] = "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
        }
    }
}

// แสดงข้อความข้อผิดพลาดหากมี
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
?>

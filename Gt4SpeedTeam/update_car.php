<?php
include 'config.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST["car_id"];
    $model = $_POST["model"];
    $manufacturer = $_POST["manufacturer"];
    $year = $_POST["year"];
    $engine = $_POST["engine"]; // เพิ่มเครื่องยนต์
    $team_id = $_POST["team_id"];

    // ใช้ prepared statement ป้องกัน SQL Injection
    $sql = "UPDATE cars SET model = ?, manufacturer = ?, year = ?, engine = ?, team_id = ? WHERE car_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssissi", $model, $manufacturer, $year, $engine, $team_id, $car_id);
        if ($stmt->execute()) {
            echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='list_cars.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post">
    ID รถ: <input type="text" name="car_id" required><br>
    รุ่นรถ: <input type="text" name="model" required><br>
    ผู้ผลิต: <input type="text" name="manufacturer" required><br>
    ปีที่ผลิต: <input type="number" name="year" required><br>
    เครื่องยนต์: <input type="text" name="engine" required><br> <!-- เพิ่มช่องเครื่องยนต์ -->
    ทีม (ID): <input type="text" name="team_id" required><br>
    <button type="submit">อัปเดตรถ</button>
</form>

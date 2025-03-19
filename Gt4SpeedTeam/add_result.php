<?php
include 'config.php'; // ดึงไฟล์เชื่อมต่อฐานข้อมูล

$error_message = ""; // ตัวแปรเก็บข้อความผิดพลาด
$success_message = ""; // ตัวแปรเก็บข้อความสำเร็จ
$race_id = $driver_id = $car_id = $position = $best_time = ""; // ค่าเริ่มต้นสำหรับฟอร์ม

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $race_id = $_POST["race_id"];
    $driver_id = $_POST["driver_id"];
    $car_id = $_POST["car_id"];
    $position = $_POST["position"];
    $best_time = $_POST["best_time"];

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
    if (empty($race_id) || empty($driver_id) || empty($car_id) || empty($position) || empty($best_time)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน!";
    } else {
        // ตรวจสอบว่า race_id, driver_id และ car_id มีอยู่จริงในฐานข้อมูล
        $check_race = $conn->query("SELECT race_id FROM races WHERE race_id = '$race_id'");
        $check_driver = $conn->query("SELECT driver_id FROM drivers WHERE driver_id = '$driver_id'");
        $check_car = $conn->query("SELECT car_id FROM cars WHERE car_id = '$car_id'");

        if ($check_race->num_rows == 0) {
            $error_message = "ไม่พบ ID สนามที่แข่ง กรุณากรอกใหม่!";
        } elseif ($check_driver->num_rows == 0) {
            $error_message = "ไม่พบนักแข่ง กรุณากรอกใหม่!";
        } elseif ($check_car->num_rows == 0) {
            $error_message = "ไม่พบรถ กรุณากรอกใหม่!";
        } else {
            // เพิ่มข้อมูลผลการแข่งขัน
            $sql = "INSERT INTO results (race_id, driver_id, car_id, position, best_time) 
                    VALUES ('$race_id', '$driver_id', '$car_id', '$position', '$best_time')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "เพิ่มผลการแข่งขันสำเร็จ!";
                // Reset form after successful submission
                $race_id = $driver_id = $car_id = $position = $best_time = "";
            } else {
                $error_message = "เกิดข้อผิดพลาด: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./5.css">
    <title>เพิ่มผลการแข่งขัน</title>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>เพิ่มผลการแข่งขัน</h1>
        </div>
        
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form action="add_result.php" method="post">
            <div class="form-group">
                <label class="required" for="race_id">ID สนามที่แข่ง</label>
                <input type="number" id="race_id" name="race_id" value="<?php echo $race_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="driver_id">ID นักแข่ง</label>
                <input type="text" id="driver_id" name="driver_id" value="<?php echo $driver_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="car_id">ID รถแข่ง</label>
                <input type="text" id="car_id" name="car_id" value="<?php echo $car_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="position">ตำแหน่งที่จบ</label>
                <input type="number" id="position" name="position" value="<?php echo $position; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="best_time">เวลาต่อรอบที่ดีที่สุด (เช่น 4:25:33)</label>
                <input type="text" id="best_time" name="best_time" value="<?php echo $best_time; ?>" required>
            </div>
            
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                <a href="menu_driver.php" class="btn btn-dark">ย้อนกลับ</a>
                <a href="menu.php" class="btn btn-dark">กลับไปหน้าเมนู</a>
            </div>
        </form>
    </div>
</body>
</html>
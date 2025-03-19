<?php
include 'config.php'; // ดึงไฟล์เชื่อมต่อฐานข้อมูล

$error_message = ""; // ตัวแปรเก็บข้อความผิดพลาด
$success_message = ""; // ตัวแปรเก็บข้อความสำเร็จ
$racename = $circuit = $date = ""; // ค่าเริ่มต้นสำหรับฟอร์ม

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $racename = $_POST["racename"];
    $circuit = $_POST["circuit"];
    $race_date = $_POST["race_date"];

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
    if (empty($racename) || empty($circuit) || empty($race_date)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน!";
    } else {
        // ดึงปีจากวันที่แข่ง
        $year = date("y", strtotime($race_date)); // ได้ปีแบบ 2 หลัก เช่น 25 (สำหรับปี 2025)

        // หากปีเริ่มต้นด้วย 0 เช่น 2001 จะได้ 01
        $year = sprintf("%02d", (int)$year); // แปลงปีเป็น 2 หลัก

        // หาค่า race_id ล่าสุดของปีนั้น
        $sql_last_id = "SELECT race_id FROM Races WHERE race_id LIKE '$year%' ORDER BY race_id DESC LIMIT 1";
        $result = $conn->query($sql_last_id);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_id = intval(substr($row["race_id"], 2)); // เอาเฉพาะตัวเลขท้าย
            $new_id = $year . str_pad($last_id + 1, 3, "0", STR_PAD_LEFT); // เพิ่มค่า +1 และคงรูปแบบ 3 หลัก
        } else {
            $new_id = $year . "001"; // ถ้ายังไม่มีรายการแข่งของปีนั้น เริ่มที่ 001
        }

        // คำสั่ง SQL สำหรับเพิ่มข้อมูลการแข่งขัน
        $sql = "INSERT INTO Races (race_id, race_name, circuit, race_date) 
                VALUES ('$new_id', '$racename', '$circuit', '$race_date')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "เพิ่มการแข่งขันสำเร็จ! race_id = " . $new_id;
            // Reset form after successful submission
            $racename = $circuit = $race_date = "";
        } else {
            $error_message = "Error: " . $conn->error;
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
    <title>เพิ่มการแข่งขัน</title>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>เพิ่มการแข่งขันใหม่</h1>
        </div>
        
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form action="add_race.php" method="post">
            <div class="form-group">
                <label class="required" for="racename">ชื่อการแข่งขัน</label>
                <input type="text" id="racename" name="racename" value="<?php echo $racename; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="circuit">สนามแข่ง</label>
                <input type="text" id="circuit" name="circuit" value="<?php echo $circuit; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="race_date">วันที่แข่งขัน</label>
                <input type="date" id="race_date" name="race_date" value="<?php echo $date; ?>" required>
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

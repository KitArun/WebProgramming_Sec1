<?php
include 'config.php'; // ดึงไฟล์เชื่อมต่อฐานข้อมูล

$error_message = ""; // ตัวแปรเก็บข้อความผิดพลาด
$success_message = ""; // ตัวแปรเก็บข้อความสำเร็จ
$team_name = $country = $founded_year = $team_principal = ""; // ค่าเริ่มต้นของฟอร์ม

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $team_name = $_POST["team_name"];
    $country = $_POST["country"];
    $founded_year = $_POST["founded_year"];
    $team_principal = $_POST["team_principal"];

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
    if (empty($team_name) || empty($country) || empty($founded_year) || empty($team_principal)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน!";
    } else {
        // คำสั่ง SQL สำหรับเพิ่มข้อมูลทีม (ไม่ต้องกำหนด team_id)
        $sql = "INSERT INTO Teams (team_name, country, founded_year, team_principal) 
                VALUES ('$team_name', '$country', '$founded_year', '$team_principal')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id; // รับค่า team_id ที่เพิ่มเข้าไป
            $success_message = "เพิ่มทีมสำเร็จ! team_id = " . $last_id;
            // Reset form after successful submission
            $team_name = $country = $founded_year = $team_principal = "";
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
    <title>เพิ่มทีม</title>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>เพิ่มทีมใหม่</h1>
        </div>
        
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form action="add_team.php" method="post">
            <div class="form-group">
                <label class="required" for="team_name">ชื่อทีม</label>
                <input type="text" id="team_name" name="team_name" value="<?php echo $team_name; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="country">ประเทศ</label>
                <input type="text" id="country" name="country" value="<?php echo $country; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="founded_year">ปีที่ก่อตั้ง</label>
                <input type="number" id="founded_year" name="founded_year" value="<?php echo $founded_year; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="team_principal">หัวหน้าทีม</label>
                <input type="text" id="team_principal" name="team_principal" value="<?php echo $team_principal; ?>" required>
            </div>
            
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                <a href="menu_teams.php" class="btn btn-dark">ย้อนกลับ</a>
                <a href="menu.php" class="btn btn-dark">กลับไปหน้าเมนู</a>
            </div>
        </form>
    </div>
</body>
</html>
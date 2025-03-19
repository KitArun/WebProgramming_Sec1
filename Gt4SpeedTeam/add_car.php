<?php
include 'config.php'; // เชื่อมต่อฐานข้อมูล

$error_message = "";
$success_message = "";
$model = $manufacturer = $engine = $chassis = $year = $team_id = "";

// ดึงข้อมูลทีมทั้งหมดเพื่อแสดงใน dropdown
$sql_teams = "SELECT team_id, team_name FROM teams ORDER BY team_name";
$teams_result = $conn->query($sql_teams);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST["model"];
    $manufacturer = $_POST["manufacturer"];
    $engine = $_POST["engine"];
    $chassis = $_POST["chassis"];
    $year = $_POST["year"];
    $team_id = $_POST["team_id"];

    if (empty($model) || empty($manufacturer) || empty($year) || empty($team_id)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน!";
    } else {
        // ตรวจสอบ team_id
        $sql_team_check = "SELECT * FROM teams WHERE team_id = '$team_id'";
        $team_result = $conn->query($sql_team_check);

        if ($team_result->num_rows == 0) {
            $error_message = "ไม่พบทีมที่มีไอดีนี้ กรุณาเลือกทีมใหม่!";
        } else {
            // ใช้ car_id = ปี (2 หลัก) + ลำดับรถในปีนั้น
            $year_short = substr($year, 2, 2); // เช่น 2024 → "24"
            $sql_count = "SELECT COUNT(*) AS car_count FROM Cars WHERE year = '$year'";
            $result = $conn->query($sql_count);
            $row = $result->fetch_assoc();
            $car_count = $row['car_count'] + 1;
            $generated_id = intval($year_short . str_pad($car_count, 3, "0", STR_PAD_LEFT));

            // ตรวจสอบว่า car_id ซ้ำหรือไม่
            while (true) {
                $sql_check = "SELECT car_id FROM Cars WHERE car_id = '$generated_id'";
                $result = $conn->query($sql_check);
                if ($result->num_rows == 0) {
                    break;
                }
                $car_count++;
                $generated_id = intval($year_short . str_pad($car_count, 3, "0", STR_PAD_LEFT));
            }

            // เพิ่มข้อมูลรถ
            $sql = "INSERT INTO Cars (car_id, model, manufacturer, engine, chassis, year, team_id) 
                    VALUES ('$generated_id', '$model', '$manufacturer', 
                            " . ($engine ? "'$engine'" : "NULL") . ", 
                            " . ($chassis ? "'$chassis'" : "NULL") . ", 
                            '$year', '$team_id')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "เพิ่มรถสำเร็จ! car_id = " . $generated_id;
                // Reset form values after successful submission
                $model = $manufacturer = $engine = $chassis = $year = $team_id = "";
            } else {
                $error_message = "Error: " . $conn->error;
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
    <title>เพิ่มรถ</title>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>เพิ่มรถใหม่</h1>
        </div>
        
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form action="add_car.php" method="post">
            <div class="form-group">
                <label class="required" for="model">รุ่นรถ</label>
                <input type="text" id="model" name="model" value="<?php echo $model; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="manufacturer">ผู้ผลิต</label>
                <input type="text" id="manufacturer" name="manufacturer" value="<?php echo $manufacturer; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="engine">เครื่องยนต์</label>
                <input type="text" id="engine" name="engine" value="<?php echo $engine; ?>">
            </div>
            
            <div class="form-group">
                <label for="chassis">หมายเลขตัวถัง</label>
                <input type="text" id="chassis" name="chassis" value="<?php echo $chassis; ?>">
            </div>
            
            <div class="form-group">
                <label class="required" for="year">ปีที่ผลิต</label>
                <input type="number" id="year" name="year" value="<?php echo $year; ?>" required>
            </div>
            
            <div class="form-group">
                <label class="required" for="team_id">ทีม</label>
                <select id="team_id" name="team_id" required>
                    <option value="">-- เลือกทีม --</option>
                    <?php
                    if ($teams_result && $teams_result->num_rows > 0) {
                        while($team_row = $teams_result->fetch_assoc()) {
                            $selected = ($team_id == $team_row['team_id']) ? 'selected' : '';
                            echo "<option value='" . $team_row['team_id'] . "' $selected>" . 
                                 $team_row['team_name'] . " (ID: " . $team_row['team_id'] . ")</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                <a href="menu_car.php" class="btn btn-dark">ย้อนกลับ</a>
                <a href="menu.php" class="btn btn-dark">กลับไปหน้าเมนู</a>
            </div>
        </form>
    </div>
</body>
</html>
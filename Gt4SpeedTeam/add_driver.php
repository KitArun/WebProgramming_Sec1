<?php
include 'config.php'; // ดึงไฟล์เชื่อมต่อฐานข้อมูล

$error_message = ""; // ตัวแปรเก็บข้อความผิดพลาด
$success_message = ""; // ตัวแปรเก็บข้อความสำเร็จ
$name = $nationality = $birth_date = $experience_years = $team_id = ""; // ค่าเริ่มต้นสำหรับฟอร์ม

// ดึงข้อมูลทีมทั้งหมดเพื่อแสดงใน dropdown
$sql_teams = "SELECT team_id, team_name FROM teams ORDER BY team_name";
$teams_result = $conn->query($sql_teams);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $name = $_POST["name"];
    $nationality = $_POST["nationality"];
    $birth_date = $_POST["birth_date"];
    $experience_years = $_POST["experience_years"];
    $team_id = $_POST["team_id"];

    // ตรวจสอบว่าไม่ได้กรอกข้อมูลช่องใดช่องหนึ่ง
    if (empty($name) || empty($nationality) || empty($birth_date) || empty($experience_years) || empty($team_id)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน!";
    } else {
        // ตรวจสอบว่า ชื่อซ้ำในฐานข้อมูลหรือไม่
        $sql_name_check = "SELECT * FROM Drivers WHERE name = '$name'";
        $name_result = $conn->query($sql_name_check);

        if ($name_result->num_rows > 0) {
            // ถ้าชื่อซ้ำให้แสดงข้อความผิดพลาด
            $error_message = "มีนักแข่งที่ชื่อเหมือนกันในฐานข้อมูลแล้ว!";
        } else {
            // ตรวจสอบว่า team_id มีในฐานข้อมูลหรือไม่
            $sql_team_check = "SELECT * FROM teams WHERE team_id = '$team_id'";
            $team_result = $conn->query($sql_team_check);

            if ($team_result->num_rows == 0) {
                // ถ้าไม่พบทีมให้แสดงข้อความผิดพลาด
                $error_message = "ไม่พบทีมที่มีไอดีนี้ กรุณาเลือกทีมใหม่!";
            } else {
                // ดึงปีจากวันเกิด
                $birth_date_arr = explode("-", $birth_date); // แยกวันที่เป็นปี เดือน วัน
                $year = substr($birth_date_arr[0], 2, 2); // เอาปี 2 ตัวหลัง
                
                // นับจำนวนนักแข่งในปีนี้
                $sql_count = "SELECT COUNT(*) AS driver_count FROM Drivers WHERE SUBSTRING(join_year, 3, 2) = '$year'";
                $result = $conn->query($sql_count);
                $row = $result->fetch_assoc();
                $driver_count = $row['driver_count'] + 1;
                
                // สร้าง ID เป็น ปี (2 หลัก) + ลำดับของนักแข่งเป็น 3 หลัก
                $generated_id = intval($year . str_pad($driver_count, 3, "0", STR_PAD_LEFT));
                
                // ตรวจสอบว่า driver_id ซ้ำหรือไม่
                while (true) {
                    $sql_check = "SELECT driver_id FROM Drivers WHERE driver_id = '$generated_id'";
                    $result = $conn->query($sql_check);
                    if ($result->num_rows == 0) {
                        break;
                    }
                    $driver_count++;
                    $generated_id = intval($year . str_pad($driver_count, 3, "0", STR_PAD_LEFT));
                }

                // คำสั่ง SQL สำหรับเพิ่มข้อมูลนักแข่ง
                $sql = "INSERT INTO Drivers (driver_id, name, nationality, join_year, experience_years, team_id) 
                        VALUES ('$generated_id', '$name', '$nationality', '$birth_date', '$experience_years', '$team_id')";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "เพิ่มนักแข่งสำเร็จ! driver_id = " . $generated_id;
                    // Reset form after successful submission
                    $name = $nationality = $birth_date = $experience_years = $team_id = "";
                } else {
                    $error_message = "Error: " . $conn->error;
                }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="2.css">
    <title>เพิ่มนักแข่ง</title>
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header>
                <h2><i class="fas fa-car-side"></i> เพิ่มนักแข่งใหม่</h2>
            </header>
            
            <div class="card">
                <div class="car-image-container">
                    <div class="car-image">
                        <i class="fas fa-user-astronaut"></i>
                    </div>
                </div>
                
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success" style="background-color: var(--success); color: white; padding: 15px; border-radius: 8px; margin: 20px 30px 0;">
                        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" style="background-color: var(--danger); color: white; padding: 15px; border-radius: 8px; margin: 20px 30px 0;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <div class="car-form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> ชื่อ</label>
                                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="nationality"><i class="fas fa-flag"></i> สัญชาติ</label>
                                <input type="text" id="nationality" name="nationality" value="<?php echo $nationality; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="birth_date"><i class="fas fa-calendar"></i> ปีที่เข้าทีม</label>
                                <input type="date" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="experience_years"><i class="fas fa-trophy"></i> ประสบการณ์ (ปี)</label>
                                <input type="number" id="experience_years" name="experience_years" value="<?php echo $experience_years; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="team_id"><i class="fas fa-users"></i> ทีม</label>
                            <select id="team_id" name="team_id" required>
                                <option value="">-- เลือกทีม --</option>
                                <?php
                                // ต้องดึงข้อมูลทีมใหม่เพราะ result set ถูกใช้ไปแล้ว
                                $teams_result = $conn->query($sql_teams);
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
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> เพิ่มข้อมูล
                            </button>
                            <a href="menu_driver.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> ย้อนกลับ
                            </a>
                            <a href="menu.php" class="btn btn-secondary">
                                <i class="fas fa-home"></i> กลับไปหน้าเมนู
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
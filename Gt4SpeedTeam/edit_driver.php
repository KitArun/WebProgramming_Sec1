<?php
include 'config.php';

// ตรวจสอบว่ามี id ของนักแข่งที่ต้องการแก้ไขหรือไม่
if (isset($_GET['id'])) {
    $driver_id = $_GET['id'];
    
    // ดึงข้อมูลนักแข่งจากฐานข้อมูล
    $sql = "SELECT * FROM drivers WHERE driver_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $driver_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $error_message = "ไม่พบข้อมูลนักแข่ง";
        }
        $stmt->close();
    }
} else {
    $error_message = "ไม่มีข้อมูลนักแข่งที่ต้องการแก้ไข";
}

// ดึงข้อมูลทีมทั้งหมดเพื่อแสดงใน dropdown
$sql_teams = "SELECT team_id, team_name FROM teams ORDER BY team_name";
$teams_result = $conn->query($sql_teams);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="2.css">
    <title>แก้ไขข้อมูลนักแข่ง</title>
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header>
                <h2><i class="fas fa-edit"></i> แก้ไขข้อมูลนักแข่ง</h2>
            </header>
            
            <div class="card">
                <div class="car-image-container">
                    <div class="car-image">
                        <i class="fas fa-user-edit"></i>
                    </div>
                </div>
                
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" style="background-color: var(--danger); color: white; padding: 15px; border-radius: 8px; margin: 20px 30px 0;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                    </div>
                <?php else: ?>
                
                <div class="car-form">
                    <form action="update_driver.php" method="post">
                        <input type="hidden" name="driver_id" value="<?php echo $row['driver_id']; ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> ชื่อ</label>
                                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="nationality"><i class="fas fa-flag"></i> สัญชาติ</label>
                                <input type="text" id="nationality" name="nationality" value="<?php echo $row['nationality']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="join_year"><i class="fas fa-calendar-alt"></i> ปีที่เข้าทีม</label>
                                <input type="date" id="join_year" name="join_year" value="<?php echo $row['join_year']; ?>" required readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="experience_years"><i class="fas fa-trophy"></i> ประสบการณ์ (ปี)</label>
                                <input type="number" id="experience_years" name="experience_years" value="<?php echo $row['experience_years']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="team_id"><i class="fas fa-users"></i> ทีม</label>
                            <select id="team_id" name="team_id" required>
                                <?php
                                // ดึงข้อมูลทีมทั้งหมด
                                $teams_result = $conn->query($sql_teams);
                                if ($teams_result && $teams_result->num_rows > 0) {
                                    while($team_row = $teams_result->fetch_assoc()) {
                                        $selected = ($team_row['team_id'] == $row['team_id']) ? 'selected' : '';
                                        echo "<option value='" . $team_row['team_id'] . "' $selected>" . 
                                             $team_row['team_name'] . " (ID: " . $team_row['team_id'] . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> บันทึกการแก้ไข
                            </button>
                            <a href="list_drivers.php" class="btn btn-secondary">
                                <i class="fas fa-list"></i> กลับไปยังรายชื่อนักแข่ง
                            </a>
                            <a href="menu.php" class="btn btn-secondary">
                                <i class="fas fa-home"></i> กลับไปหน้าเมนู
                            </a>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
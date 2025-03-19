<?php
include 'config.php';

// ตรวจสอบว่ามี ID ของผลการแข่งขันที่ต้องการแก้ไขหรือไม่
if (isset($_GET['id'])) {
    $result_id = $_GET['id'];

    // ดึงข้อมูลผลการแข่งขันจากฐานข้อมูล
    $sql = "SELECT r.result_id, rc.race_name, d.name AS driver_name, t.team_name, 
                   c.model AS car_model, r.position, r.best_time, rc.circuit, 
                   rc.lap_count, rc.race_date
            FROM results r
            JOIN races rc ON r.race_id = rc.race_id
            JOIN drivers d ON r.driver_id = d.driver_id
            JOIN teams t ON d.team_id = t.team_id
            JOIN cars c ON r.car_id = c.car_id
            WHERE r.result_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $result_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "ไม่พบข้อมูลผลการแข่งขัน";
            exit;
        }
        $stmt->close();
    }
} else {
    echo "ไม่มีข้อมูลผลการแข่งขันที่ต้องการแก้ไข";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผลการแข่งขัน</title>
    <link rel="stylesheet" href="./2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header>
                <h2><i class="fas fa-trophy"></i> แก้ไขข้อมูลผลการแข่งขัน</h2>
            </header>
            
            <div class="card">
                <div class="car-image-container">
                    <div class="car-image">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                </div>
                
                <div class="car-form">
                    <form action="update_result.php" method="post">
                        <input type="hidden" name="result_id" value="<?php echo htmlspecialchars($row['result_id']); ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="race_name"><i class="fas fa-racing-flag"></i> ชื่อรายการแข่งขัน</label>
                                <input type="text" name="race_name" id="race_name" value="<?php echo htmlspecialchars($row['race_name']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="driver_name"><i class="fas fa-user-astronaut"></i> นักแข่ง</label>
                                <input type="text" name="driver_name" id="driver_name" value="<?php echo htmlspecialchars($row['driver_name']); ?>" disabled>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="team_name"><i class="fas fa-users"></i> ทีม</label>
                                <input type="text" name="team_name" id="team_name" value="<?php echo htmlspecialchars($row['team_name']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="car_model"><i class="fas fa-car-side"></i> รถแข่ง</label>
                                <input type="text" name="car_model" id="car_model" value="<?php echo htmlspecialchars($row['car_model']); ?>" disabled>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="position"><i class="fas fa-medal"></i> ตำแหน่งที่จบ</label>
                                <input type="number" name="position" id="position" value="<?php echo htmlspecialchars($row['position']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="best_time"><i class="fas fa-stopwatch"></i> เวลาต่อรอบที่ดีที่สุด</label>
                                <input type="text" name="best_time" id="best_time" value="<?php echo htmlspecialchars($row['best_time']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="lap_count"><i class="fas fa-sync"></i> จำนวนรอบ</label>
                                <input type="number" name="lap_count" id="lap_count" value="<?php echo htmlspecialchars($row['lap_count']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="race_date"><i class="fas fa-calendar-alt"></i> วันที่แข่ง</label>
                                <input type="date" name="race_date" id="race_date" value="<?php echo htmlspecialchars($row['race_date']); ?>" disabled>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกการแก้ไข</button>
                            <a href="list_results.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include 'config.php';

// ตรวจสอบว่ามี id ของสนามแข่งที่ต้องการแก้ไขหรือไม่
if (isset($_GET['id'])) {
    $race_id = $_GET['id'];

    // ดึงข้อมูลสนามแข่งจากฐานข้อมูล
    $sql = "SELECT * FROM races WHERE race_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $race_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "ไม่พบข้อมูลสนามแข่ง";
            exit;
        }
        $stmt->close();
    }
} else {
    echo "ไม่มีข้อมูลสนามแข่งที่ต้องการแก้ไข";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสนามแข่ง</title>
    <link rel="stylesheet" href="2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header>
                <h2><i class="fas fa-flag-checkered"></i> แก้ไขข้อมูลสนามแข่ง</h2>
            </header>
            
            <div class="card">
                <div class="car-image-container">
                    <div class="car-image">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
                
                <div class="car-form">
                    <form action="update_race.php" method="post">
                        <input type="hidden" name="race_id" value="<?php echo $row['race_id']; ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="race_name"><i class="fas fa-racing-flag"></i> ชื่อการแข่งขัน</label>
                                <input type="text" name="race_name" id="race_name" value="<?php echo $row['race_name']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="circuit"><i class="fas fa-road"></i> สนามแข่ง</label>
                                <input type="text" name="circuit" id="circuit" value="<?php echo $row['circuit']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="lap_count"><i class="fas fa-sync"></i> จำนวนรอบ</label>
                                <input type="number" name="lap_count" id="lap_count" value="<?php echo $row['lap_count']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="race_date"><i class="fas fa-calendar-alt"></i> วันที่แข่ง</label>
                                <input type="date" name="race_date" id="race_date" value="<?php echo $row['race_date']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกการแก้ไข</button>
                            <a href="list_races.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> กลับไปยังรายการ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
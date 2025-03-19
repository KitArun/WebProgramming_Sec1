<?php
include 'config.php';
if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $sql = "SELECT * FROM cars WHERE car_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "ไม่พบข้อมูลรถ";
            exit;
        }
        $stmt->close();
    }
} else {
    echo "ไม่มีข้อมูลรถที่ต้องการแก้ไข";
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรถแข่ง</title>
    <link rel="stylesheet" href="./2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header>
                <h2><i class="fas fa-car-side"></i> แก้ไขข้อมูลรถแข่ง</h2>
            </header>
            
            <div class="card">
                <div class="car-image-container">
                    <div class="car-image">
                        <i class="fas fa-car"></i>
                    </div>
                </div>
                
                <div class="car-form">
                    <form action="update_car.php" method="post">
                        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($row['car_id']); ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="model"><i class="fas fa-car-alt"></i> รุ่นรถ</label>
                                <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($row['model']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="manufacturer"><i class="fas fa-industry"></i> ผู้ผลิต</label>
                                <input type="text" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($row['manufacturer']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="year"><i class="fas fa-calendar-alt"></i> ปีที่ผลิต</label>
                                <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($row['year']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="engine"><i class="fas fa-cogs"></i> เครื่องยนต์</label>
                                <input type="text" id="engine" name="engine" value="<?php echo htmlspecialchars($row['engine']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="team_id"><i class="fas fa-users"></i> ทีม</label>
                                <select id="team_id" name="team_id" required>
                                    <?php
                                    // ดึงข้อมูลทีมทั้งหมด
                                    $sql = "SELECT team_id, team_name FROM teams";
                                    $result = $conn->query($sql);
                                    while ($team = $result->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($team['team_id']) . '" ' . 
                                            ($team['team_id'] == $row['team_id'] ? 'selected' : '') . '>' . 
                                            htmlspecialchars($team['team_name']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกการแก้ไข</button>
                            <a href="list_cars.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> กลับไปยังรายชื่อรถ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

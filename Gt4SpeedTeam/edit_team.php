<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "ไม่พบ ID ทีม";
    exit();
}

$team_id = intval($_GET['id']);
$sql = "SELECT * FROM teams WHERE team_id = $team_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "ไม่พบข้อมูลทีมนี้";
    exit();
}

$team = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขทีม</title>
    <link rel="stylesheet" href="./2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header>
                <h2><i class="fas fa-users"></i> แก้ไขทีม: <?= htmlspecialchars($team['team_name']) ?></h2>
            </header>
            
            <div class="card">
                <div class="car-image-container">
                    <div class="car-image">
                        <i class="fas fa-flag"></i>
                    </div>
                </div>
                
                <div class="car-form">
                    <form action="update_team.php" method="post">
                        <input type="hidden" name="team_id" value="<?= htmlspecialchars($team['team_id']) ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="team_name"><i class="fas fa-users"></i> ชื่อทีม</label>
                                <input type="text" id="team_name" name="team_name" value="<?= htmlspecialchars($team['team_name']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="country"><i class="fas fa-globe-asia"></i> ประเทศ</label>
                                <input type="text" id="country" name="country" value="<?= htmlspecialchars($team['country']) ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="founded_year"><i class="fas fa-calendar-alt"></i> ก่อตั้งปี</label>
                                <input type="number" id="founded_year" name="founded_year" value="<?= htmlspecialchars($team['founded_year']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="team_principal"><i class="fas fa-user-tie"></i> หัวหน้าทีม</label>
                                <input type="text" id="team_principal" name="team_principal" value="<?= htmlspecialchars($team['team_principal']) ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกการแก้ไข</button>
                            <a href="list_teams.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
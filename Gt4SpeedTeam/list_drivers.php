<?php
include 'config.php';

$sql = "SELECT drivers.driver_id, drivers.name, drivers.nationality, drivers.join_year, drivers.experience_years, teams.team_name 
        FROM drivers
        JOIN teams ON drivers.team_id = teams.team_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="6.css">
    <title>รายชื่อนักแข่ง</title>
</head>
<body>
    <div class="container">
        <h1>รายชื่อนักแข่งทั้งหมด</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ชื่อ</th>
                        <th>สัญชาติ</th>
                        <th>ปีที่เข้าทีม</th>
                        <th>ประสบการณ์ (ปี)</th>
                        <th>ทีม</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // ใช้ loop และ echo สำหรับการแสดงผล
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["driver_id"] . '</td>';
                            echo '<td>' . $row["name"] . '</td>';
                            echo '<td>' . $row["nationality"] . '</td>';
                            echo '<td>' . $row["join_year"] . '</td>';
                            echo '<td>' . $row["experience_years"] . '</td>';
                            echo '<td>' . $row["team_name"] . '</td>';
                            echo '<td><a href="edit_driver.php?id=' . $row['driver_id'] . '" class="action-link edit">[แก้ไข]</a></td>';
                            echo '<td><a href="delete_driver.php?id=' . $row['driver_id'] . '" class="action-link delete" onclick="return confirm(\'แน่ใจหรือไม่ว่าต้องการลบ?\');">[ลบ]</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8" class="no-data">ไม่มีข้อมูลนักแข่ง</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="button-container">
            <a href="menu_driver.php" class="button">ย้อนกลับ</a>
            <a href="menu.php" class="button">กลับไปหน้าเมนู</a>
        </div>
    </div>
</body>
</html>
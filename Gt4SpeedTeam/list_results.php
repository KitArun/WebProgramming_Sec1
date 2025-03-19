<?php
include 'config.php'; // ดึงไฟล์เชื่อมต่อฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="6.css">
    <title>รายการผลการแข่งขัน</title>
</head>
<body>
    <div class="container">
        <h1>รายการผลการแข่งขัน</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID ผลการแข่งขัน</th>
                        <th>ชื่อรายการแข่งขัน</th>
                        <th>ชื่อสนาม</th>
                        <th>นักแข่ง</th>
                        <th>ทีม</th>
                        <th>รถแข่ง</th>
                        <th>ตำแหน่งที่จบ</th>
                        <th>เวลาต่อรอบที่ดีที่สุด</th>
                        <th>จำนวนรอบ</th>
                        <th>วันที่แข่ง</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ดึงข้อมูลจากฐานข้อมูล รวมทีมของนักแข่ง
                    $sql = "SELECT r.result_id, rc.race_name, d.name AS driver_name, t.team_name, 
                                   c.model AS car_model, r.position, r.best_time, 
                                   rc.circuit, rc.lap_count, rc.race_date
                            FROM results r
                            JOIN races rc ON r.race_id = rc.race_id
                            JOIN drivers d ON r.driver_id = d.driver_id
                            JOIN teams t ON d.team_id = t.team_id
                            JOIN cars c ON r.car_id = c.car_id
                            ORDER BY r.result_id DESC";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['result_id']) . "</td>
                                    <td>" . htmlspecialchars($row['race_name']) . "</td>
                                    <td>" . htmlspecialchars($row['circuit']) . "</td>
                                    <td>" . htmlspecialchars($row['driver_name']) . "</td>
                                    <td>" . htmlspecialchars($row['team_name']) . "</td>
                                    <td>" . htmlspecialchars($row['car_model']) . "</td>
                                    <td>" . htmlspecialchars($row['position']) . "</td>
                                    <td>" . htmlspecialchars($row['best_time']) . "</td>
                                    <td>" . htmlspecialchars($row['lap_count']) . "</td>
                                    <td>" . htmlspecialchars($row['race_date']) . "</td>
                                    <td> <a href='edit_result.php?id=" . htmlspecialchars($row['result_id'], ENT_QUOTES, 'UTF-8') . "' class='action-link edit'>[แก้ไข]</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' class='no-data'>ไม่มีข้อมูลผลการแข่งขัน</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="button-container">
            <a href="menu_results.php" class="button">ย้อนกลับ</a>
            <a href="menu.php" class="button">กลับไปหน้าเมนู</a>
        </div>
    </div>
</body>
</html>

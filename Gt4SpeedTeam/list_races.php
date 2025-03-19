<?php
include 'config.php'; // เชื่อมต่อฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="6.css">
    <title>รายการแข่งขัน</title>
</head>
<body>
    <div class="container">
        <h1>รายการแข่งขันทั้งหมด</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Race ID</th>
                        <th>ชื่อรายการแข่งขัน</th>
                        <th>สนามแข่ง</th>
                        <th>จำนวนรอบ</th>
                        <th>วันที่แข่ง</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT race_id, race_name, circuit, lap_count, race_date 
                            FROM Races 
                            ORDER BY race_date DESC, race_id ASC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['race_id'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['race_name'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['circuit'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['lap_count'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['race_date'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td> <a href='edit_race.php?id=" . htmlspecialchars($row['race_id'], ENT_QUOTES, 'UTF-8') . "' class='action-link edit'>[แก้ไข]</a></td>
                                    <td> <a href='delete_race.php?id=" . htmlspecialchars($row['race_id'], ENT_QUOTES, 'UTF-8') . "' class='action-link delete' onclick='return confirm(\"ยืนยันการลบ?\");'>[ลบ]</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='no-data'>ไม่มีข้อมูลการแข่งขัน</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="button-container">
            <a href="menu_races.php" class="button">ย้อนกลับ</a>
            <a href="menu.php" class="button">กลับไปหน้าเมนู</a>
        </div>
    </div>
</body>
</html>

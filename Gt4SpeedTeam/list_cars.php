<?php
include 'config.php'; // เชื่อมต่อฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="6.css">
    <title>รายการรถ</title>
</head>
<body>
    <div class="container">
        <h1>รายการรถทั้งหมด</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>รุ่น</th>
                        <th>ผู้ผลิต</th>
                        <th>เครื่องยนต์</th>
                        <th>หมายเลขตัวถัง</th>
                        <th>ปีที่ผลิต</th>
                        <th>ทีม</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT c.car_id, c.model, c.manufacturer, c.engine, c.chassis, c.year, t.team_name 
                            FROM Cars c 
                            LEFT JOIN Teams t ON c.team_id = t.team_id
                            ORDER BY c.year DESC, c.car_id ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['model']}</td>
                                    <td>{$row['manufacturer']}</td>
                                    <td>" . ($row['engine'] ? $row['engine'] : '-') . "</td>
                                    <td>" . ($row['chassis'] ? $row['chassis'] : '-') . "</td>
                                    <td>{$row['year']}</td>
                                    <td>" . ($row['team_name'] ? $row['team_name'] : 'ไม่ระบุ') . "</td>
                                    <td> <a href='edit_car.php?id={$row['car_id']}' class='action-link edit'>[แก้ไข]</a></td>
                                    <td> <a href='delete_car.php?id={$row['car_id']}' class='action-link delete' onclick='return confirm(\"แน่ใจหรือไม่ว่าต้องการลบ?\");'>[ลบ]</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='no-data'>ไม่มีข้อมูลรถ</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="button-container">
            <a href="menu_car.php" class="button">ย้อนกลับ</a>
            <a href="menu.php" class="button">กลับไปหน้าเมนู</a>
        </div>
    </div>
</body>
</html>

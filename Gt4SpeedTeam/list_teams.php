<?php
include 'config.php'; // ดึงไฟล์เชื่อมต่อฐานข้อมูล

$sql = "SELECT * FROM teams"; // ดึงข้อมูลจากตาราง teams
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="6.css">
    <title>รายชื่อทีม</title>
</head>
<body>
    <div class="container">
        <h1>รายชื่อทีม</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID ทีม</th>
                        <th>ชื่อทีม</th>
                        <th>ประเทศ</th>
                        <th>ก่อตั้งปี</th>
                        <th>หัวหน้าทีม</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['team_id']}</td>
                                    <td>{$row['team_name']}</td>
                                    <td>{$row['country']}</td>
                                    <td>{$row['founded_year']}</td>
                                    <td>{$row['team_principal']}</td>
                                    <td><a href='edit_team.php?id={$row['team_id']}' class='action-link edit'>[แก้ไข]</a></td>
                                    <td><a href='delete_team.php?id={$row['team_id']}' class='action-link delete' onclick='return confirm(\"ต้องการลบทีมนี้หรือไม่?\");'>[ลบ]</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='no-data'>ไม่มีข้อมูลทีม</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="button-container">
            <a href="menu_teams.php" class="button">ย้อนกลับ</a>
            <a href="menu.php" class="button">กลับไปหน้าเมนู</a>
        </div>
    </div>
</body>
</html>

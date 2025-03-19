<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "ไม่พบ ID ทีม";
    exit();
}

$team_id = intval($_GET['id']);

$sql = "DELETE FROM teams WHERE team_id = $team_id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('ลบทีมสำเร็จ'); window.location='list_teams.php';</script>";
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}
?>

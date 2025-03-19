<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team_id = intval($_POST['team_id']);
    $team_name = $conn->real_escape_string($_POST['team_name']);
    $country = $conn->real_escape_string($_POST['country']);
    $founded_year = intval($_POST['founded_year']);
    $team_principal = $conn->real_escape_string($_POST['team_principal']);

    $sql = "UPDATE teams SET 
                team_name = '$team_name', 
                country = '$country', 
                founded_year = $founded_year, 
                team_principal = '$team_principal' 
            WHERE team_id = $team_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='list_teams.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
} else {
    echo "คำขอไม่ถูกต้อง";
}
?>

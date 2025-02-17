<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "bookStore";

$conn = mysqli_connect($hostname, $username, $password);
if (!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");
mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล bookStore ได้");
mysqli_query($conn, "set character_set_connection=utf8mb4");
mysqli_query($conn, "set character_set_client=utf8mb4");
mysqli_query($conn, "set character_set_results=utf8mb4");

$bookId = $_REQUEST['bookId'];
$sql = "SELECT * FROM book WHERE BookID = $bookId";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {
    $bookName = $_POST['bookName'];
    $typeId = $_POST['typeId'];
    $statusId = $_POST['statusId'];
    $publish = $_POST['publish'];
    $unitPrice = $_POST['unitPrice'];
    $unitRent = $_POST['unitRent'];
    $dayAmount = $_POST['dayAmount'];

    $updateSql = "UPDATE book SET BookName='$bookName', TypeID='$typeId', StatusID='$statusId', Publish='$publish', UnitPrice='$unitPrice', UnitRent='$unitRent', DayAmount='$dayAmount' WHERE BookID='$bookId'";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='bookList1.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลหนังสือ</title>
</head>
<body>
    <h3 align="center">แก้ไขข้อมูลหนังสือ</h3>
    <form method="post" action="">
        <table border="1" align="center" cellpadding="5">
            <tr>
                <td>รหัสหนังสือ:</td>
                <td><?php echo $data['BookID']; ?></td>
            </tr>
            <tr>
                <td>ชื่อหนังสือ:</td>
                <td><input type="text" name="bookName" value="<?php echo $data['BookName']; ?>" required></td>
            </tr>
            <tr>
                <td>ประเภทหนังสือ:</td>
                <td><input type="text" name="typeId" value="<?php echo $data['TypeID']; ?>" required></td>
            </tr>
            <tr>
                <td>สถานะหนังสือ:</td>
                <td><input type="text" name="statusId" value="<?php echo $data['StatusID']; ?>" required></td>
            </tr>
            <tr>
                <td>สำนักพิมพ์:</td>
                <td><input type="text" name="publish" value="<?php echo $data['Publish']; ?>" required></td>
            </tr>
            <tr>
                <td>ราคาซื้อ:</td>
                <td><input type="text" name="unitPrice" value="<?php echo $data['UnitPrice']; ?>" required></td>
            </tr>
            <tr>
                <td>ราคาเช่า:</td>
                <td><input type="text" name="unitRent" value="<?php echo $data['UnitRent']; ?>" required></td>
            </tr>
            <tr>
                <td>จำนวนวันที่ยืมได้:</td>
                <td><input type="text" name="dayAmount" value="<?php echo $data['DayAmount']; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="บันทึกการแก้ไข">
                    <a href="bookList1.php">ยกเลิก</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>

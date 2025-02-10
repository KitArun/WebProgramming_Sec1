<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data Book</title>
</head>

<body>
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "bookStore";
    $bookId = $_REQUEST['bookId'];
    $conn = mysqli_connect($hostname, $username, $password);
    
    if (!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");
    mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล bookStore ได้");
    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");

    $sql = "select * from book where BookID = $bookId";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    $Path = "pictures/";
    $image = "<img src=\"$Path" . htmlspecialchars($data['Picture']) . "\" valign=\"middle\" align=\"center\" width=\"80\" height=\"100\">";

    // Display the book details in a table
    echo "<table border=\"1\" align=\"center\" bgcolor=\"#FFCCCC\">";
    echo "<tr><td align=\"center\" colspan=\"2\" bgcolor=\"#FF99CC\"><b>แสดงรายละเอียดหนังสือ</b></td></tr>";
    echo "<tr><td> รหัสหนังสือ : </td><td>" . htmlspecialchars($data['BookID']) . "</td></tr>";
    echo "<tr><td> ชื่อหนังสือ : </td><td>" . htmlspecialchars($data['BookName']) . "</td></tr>";
    echo "<tr><td> ประเภทหนังสือ : </td><td>" . htmlspecialchars($data['TypeID']) . "</td></tr>";
    echo "<tr><td> สถานะหนังสือ : </td><td>" . htmlspecialchars($data['StatusID']) . "</td></tr>";
    echo "<tr><td> สำนักพิมพ์ : </td><td>" . htmlspecialchars($data['Publish']) . "</td></tr>";
    echo "<tr><td> ราคาซื้อ : </td><td>" . htmlspecialchars($data['UnitPrice']) . "</td></tr>";
    echo "<tr><td> ราคาเช่า : </td><td>" . htmlspecialchars($data['UnitRent']) . "</td></tr>";
    echo "<tr><td> รูปภาพ : </td><td>" . $image . "</td></tr>";
    echo "<tr><td>จำนวนวันที่ยืมได้ : </td><td>" . htmlspecialchars($data['DayAmount']) . "</td></tr>";
    echo "<tr><td> วันที่จัดเก็บหนังสือ : </td><td>" . htmlspecialchars($data['BookDate']) . "</td></tr>";
    echo "</table>";

    // Close the connection
    $conn->close();
    ?>

    <br>
    <div align="center"><a href="bookList1.php">กลับหน้าหลัก</a></div><br>
</body>

</html>
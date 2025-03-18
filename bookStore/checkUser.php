<?php
session_start();

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("ไม่สามารถติดต่อกับ MySQL ได้");
}

$sqltxt = "SELECT * FROM login WHERE username = ?";
$stmt = mysqli_prepare($conn, $sqltxt);

mysqli_stmt_bind_param($stmt, "s", $Username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$rs = mysqli_fetch_array($result);

if ($rs) {
    if ($rs['password'] == $Password) {
        $_SESSION['Username'] = $Username;
        header("Location: bookList1.php?Username=$Username");
        exit();
    } else {
        echo "<br>Password not match.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login</a>";
    }
} else {
    echo "Not found Username " . $Username;
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}

// Close the database connection
mysqli_close($conn);
?>

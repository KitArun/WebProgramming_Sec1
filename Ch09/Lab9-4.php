<html>

<head>
    <title>แสดงการใช้งาน foreach เข้าถึง Associative Array</title>
</head>

<body>
    <?php
    $products = array(
        "T0001" => "บล็อดหยอดหมีพูห์",
        "T0004" => "ตุ๊กตากบ สอน ABC",
        "T0005" => "ดต๊ะกิจกรรม",
        "P0001" => "กระดานลื่นสุขสันต์",
        "B0001" => "หนังสือมีเสียง: Pooh 's Musical"
    );

    echo "<table align='center'><tr><td>";
    echo "<table align='center' width='400' border='1'>";
    echo "<tr><th>รหัสสินค้า</th><th>ชื่อสินค้า</th></tr>";
    foreach ($products as $key => $value) {
        echo "<tr><td align='center'> $key </td><td> $value </td></tr>";
    }
    echo "</table>";
    echo "</td><td>";
    echo "<table align='center' width='400' border='1'>";
    echo "<tr><th>ล าดับที่</th><th>ชื่อสินค้า</th></tr>";
    $n = 1;
    foreach ($products as $value) {
        echo "<tr><td align='center'> $n </td><td> $value </td></tr>";
        $n++;
    }
    echo "</table>";
    echo "</td></tr></table>";
    ?>
</body>

</html>
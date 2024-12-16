<html>

<head>
    <title>แสดงการใช้งาน continue </title>
</head>

<body>
    <?php
    $start = -2;
    $end = 3;
    for ($num = $start; $num <= $end; $num++) {
        if ($num == 0) {
            echo "*** ข้ามการหารด้วยศูนย์ เพื่อไม่ให้เกิดความผิดพลาด ***<br>";
            continue;
        }
        echo "100 / $num = " . (100 / $num) . " <br>";
    }
    ?>
</body>

</html>
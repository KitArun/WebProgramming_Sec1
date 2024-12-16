<html>

<head>
    <title>แสดงการใช้งาน for </title>
</head>

<body>
    <?php
    $found = false;
    for ($num = 100; $num <= 200; $num++) {
        if ($num % 13 == 0) {
            $found = true;
            break;
        }
    }
    if ($found)
        echo "เลขจ านวนเต็มที่อยู่ในช่วง 100 ถึง 200 ที่น้อยที่สุดและหารด้วย 13 ลงตัวคือ $num<br>";
    else
        echo "ไม่มีเลขจ านวนเต็มที่อยู่ในช่วง 100 ถึง 200 ที่น้อยที่สุดและหารด้วย 13 ลงตัว<br>";
    ?>
</body>

</html>
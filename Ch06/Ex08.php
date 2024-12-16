<html>

<head>
    <title>แสดงการใช้งาน for </title>
</head>

<body>
    <?php
    for ($num = 1; $num <= 15; $num += 3) {
        $square = $num * $num;
        echo "$num is power two = $square<br>";
    }
    ?>
</body>

</html>
<html>
<html>

<head>
    <title>แสดงการใช้งาน while </title>
</head>

<body>
    <?php
    $num = 1;
    while ($num < 10) {
        if ($num % 2 == 0)
            echo "$num is Even Number <br>";
        else
            echo "$num is Odd Number <br>";
        $num++;
    }
    ?>
</body>

</html>
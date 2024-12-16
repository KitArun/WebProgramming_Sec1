<html>

<head>
    <title>แสดงการใช้งาน Bitwise Operator </title>
</head>

<body>
    <?php
    $a = 9;
    $b = 10;
    echo "\$a = $a, \$b = $b <br/>";
    echo "\$a & \$b = " . ($a & $b) . " <br/>";
    echo "\$a | \$b = " . ($a | $b) . " <br/>";
    echo "\$a ^ \$b = " . ($a ^ $b) . " <br/>";
    echo "~ \$a = " . ~$a . " <br/>";
    echo "~ \$b = " . ~$b . " <br/>";
    echo "\$a << 2 = " . ($a << 2) . " <br/>";
    echo "\$b >> 2 = " . ($a >> 2) . " <br/>";
    ?>
</body>

</html>
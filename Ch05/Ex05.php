<html>

<head>
    <title>แสดงการใช้งาน Comparison Operator </title>
</head>

<body>
    <?php
    $x = 10;
    $y = 10.0;
    $result = ($x < $y);
    echo "\$x < \$y = $result <br/>";
    $result = ($x <= $y);
    echo "\$x <= \$y = $result <br/>";
    $result = ($x > $y);
    echo "\$x > \$y = $result <br/>";
    $result = ($x >= $y);
    echo "\$x >= \$y = $result <br/>";
    $result = ($x == $y);
    echo "\$x == \$y = $result <br/>";
    $result = ($x != $y);
    echo "\$x != \$y = $result <br/>";
    $result = ($x === $y);
    echo "\$x === \$y = $result <br/>";
    ?>
</body>

</html>
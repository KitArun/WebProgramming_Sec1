<html>

<head>
    <title>แสดงการใช้งาน Logical Operator </title>
</head>

<body>
    <?php
    $x = true;
    $y = false;
    echo "\$x = true, \$y = false <br/>";
    echo "!\$x = " . (!$x) . " <br/>";
    echo "!\$y = " . (!$y) . " <br/>";
    echo "\$x && \$y = " . ($x && $y) . " <br/>";
    echo "\$x || \$y = " . ($x || $y) . " <br/>";
    echo "\$x ^ \$y = " . ($x ^ $y) . " <br/>";
    ?>
</body>

</html>
<html>

<head>
    <title>แสดงการใช้งาน Assignment Operator </title>
</head>

<body>
    <?php
    $x = 10;
    $y = 20;
    echo "\$x = $x, \$y = $y <br/>";
    $y += $x;
    echo "\$y += \$x = $y <br/>";
    $x -= 3;
    echo "\$x -= 3 = $x <br/>";
    $x *= 3;
    echo "\$x *= 3 = $x <br/>";
    $y /= 4;
    echo "\$y /= 4 = $y <br/>";
    $y %= $x;
    echo "\$y %= \$x = $y <br/>";
    $name = "John";
    echo "\$name = $name <br/>";
    $name .= " Smith";
    echo "\$name .= \" Smith\" = $name <br />";
    ?>
</body>

</html>
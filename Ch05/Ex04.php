<html>

<head>
    <title>แสดงการใช้งาน Incrementing/Decrementing Operator </title>
</head>

<body>
    <?php
    $a = 10;
    $b = ++$a * 20;
    echo "บรรทัด 1: \$a = $a, \$b = $b <br/>";
    $a = 10;
    $b = $a++ * 20;
    echo "บรรทัด 2: \$a = $a, \$b = $b <br/>";
    $a = 10;
    $b = --$a * 20;
    echo "บรรทัด 3: \$a = $a, \$b = $b <br/>";
    $a = 10;
    $b = $a-- * 20;
    echo "บรรทัด 1: \$a = $a, \$b = $b <br/>";
    ?>
</body>

</html>
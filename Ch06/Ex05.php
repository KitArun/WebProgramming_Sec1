<html>

<head>
    <title>แสดงการใช้งาน switch </title>
</head>

<body>
    <?php
    $grade = 'A';
    $point = 0;
    switch ($grade) {
        case 'A':
            $point = 4;
            break;
        case 'B':
            $point = 3;
            break;
        case 'C':
            $point = 2;
            break;
        case 'D':
            $point = 1;
            break;
        case 'F':
            $point = 0;
    }
    echo "Subject 662325 Web Programming<br/>";
    echo "You got $grade and has $point points.<br/>";
    ?>
</body>

</html>
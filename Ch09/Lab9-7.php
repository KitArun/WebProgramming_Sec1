<html>

<head>
    <title>แสดงการสร้างและเข้าถึง Numeric Array แบบหลายมิติ</title>
</head>

<body>
    <?php
    $maxRow = 10;
    $maxCol = 4;
    $score = array();
    for ($r = 0; $r < $maxRow; $r++) {
        for ($c = 0; $c < $maxCol; $c++) {
            if ($c == 0) {
                $score[$r][$c] = rand(0, 10);
            } elseif ($c == 1) {
                $score[$r][$c] = rand(0, 20);
            } elseif ($c == 2) {
                $score[$r][$c] = rand(0, 35);
            } elseif ($c == 3) {
                $score[$r][$c] = rand(0, 35);
            }
        }
    }
    echo "<table border='1' align='center' width='100%'>";
    echo "<tr><td width='80' align='center'>Homework</td>";
    echo "<td width='80' align='center'>Assignment</td>";
    echo "<td width='80' align='center'>Midterm</td>";
    echo "<td width='80' align='center'>Final</td>";
    echo "<td width='80' align='center'>100</td></tr>";
    for ($r = 0; $r < $maxRow; $r++) {
        echo "<tr>";
        $rowTotal = 0;
        for ($c = 0; $c < $maxCol; $c++) {
            echo "<td align='center'>" . $score[$r][$c] . "</td>";
            $rowTotal += $score[$r][$c];
        }
        echo "<td align='center'>" . $rowTotal . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>
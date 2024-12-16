<html>

<head>
    <title>แสดงการใช้งาน if-else </title>
</head>

<body>
    <?php
    $score = 60;
    $limit = 50;
    $name = "Somchai";
    if ($score >= $limit) {
        echo "Student Name : $name <br/>";
        echo "Student Score :$score (Passed) <br/>";
    } else {
        echo "Student Name : $name <br/>";
        echo "Student Score :$score (Failed) <br/>";
    }
    ?>
</body>

</html>
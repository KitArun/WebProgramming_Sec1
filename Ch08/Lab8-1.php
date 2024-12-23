<html>

<head>
    <title>แสดงการสร้างและใช้ฟังก์ชั่น</title>
</head>

<body>
    <?
    function say_Hello()
    {
        echo "Hello PHP<br>";
    }
    ?>
    <h2> การเรียกฟังก์ชั่นครั้งที่ 1 : </h2>
    <?
    say_Hello();
    ?>
    <hr />
    <h2> การเรียกฟังก์ชั่นครั้งที่ 2 : </h2>
    <?
    Say_Hello();
    ?>
    <hr />
    <h2> การเรียกฟังก์ชั่นครั้งที่ 3 : </h2>
    <?
    Say_hello();
    ?>
</body>

</html
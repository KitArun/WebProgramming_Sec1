<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Selector</title>
    <link rel="stylesheet" type="text/css" href="Assgin.css">
</head>
<body>
    <?php
        echo '<h2 class="big">ประวัติ</h2>';
        echo '<p class="normal">';

        // กำหนดค่าตัวแปร
        $name = '<b>ชื่อ</b> นายกิตตินาถ <b>นามสกุล</b> อรุณทวีรุ่งโรจน์';
        $numid = '<b>เลขประจำตัว</b> 6606021610052<br>';
        $sec = '<b>Sec </b>- 1<br>';
        $major = '<b>สาขา</b> เทคโนโลยีสารสนเทศ <br>';
        $faculty = '<b>คณะ</b> เทคโนโลยีสารสนเทศและการจัดการอุตสาหกรรม';

        // แสดงผลตัวแปรด้วย echo
        echo $name;
        echo $numid;
        echo $sec;
        echo $major;
        echo $faculty;

        echo '</p>';
        echo '<p class="normal">By : ประวัติส่วนตัว</p>';
        echo '<p class="small">Silver Wolf</p>';
    ?>
</body>
</html>

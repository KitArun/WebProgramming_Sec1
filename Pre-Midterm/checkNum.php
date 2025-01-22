<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบตัวเลขที่หารลงตัว</title>
</head>
<body>
    <?php
    // ฟังก์ชันสำหรับตรวจสอบตัวเลขที่หารลงตัว
    function checkNum($start, $end, $divisor) {
        $numbers = [];
        for ($num = $start; $num <= $end; $num++) {
            if ($num % $divisor == 0) {
                $numbers[] = $num;
            }
        }
        return $numbers;
    }

    // ฟังก์ชันสำหรับนับจำนวนของตัวเลขที่หารลงตัว
    function countNum($start, $end, $divisor) {
        $count = 0;
        for ($num = $start; $num <= $end; $num++) {
            if ($num % $divisor == 0) {
                $count++;
            }
        }
        return $count;
    }

    // ฟังก์ชันสำหรับหาผลรวมของตัวเลขที่หารลงตัว
    function sumNum($start, $end, $divisor) {
        $total = 0;
        for ($num = $start; $num <= $end; $num++) {
            if ($num % $divisor == 0) {
                $total += $num;
            }
        }
        return $total;
    }

    // ตรวจสอบว่าได้ส่งข้อมูลมาจากฟอร์มหรือไม่
    $numbers = [];
    $count = 0;
    $total = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start = (int) $_POST['start'];
        $end = (int) $_POST['end'];
        $divisor = (int) $_POST['divisor'];

        // เรียกใช้ฟังก์ชันต่างๆ
        $numbers = checkNum($start, $end, $divisor);
        $count = countNum($start, $end, $divisor);
        $total = sumNum($start, $end, $divisor);
    }
    ?>

    <form method="POST" action="">
        <table border="0" style="margin: 0 auto;">
            <tr>
                <td><label for="start">ค่าเริ่มต้น:</label></td>
                <td><input type="number" id="start" name="start" required></td>
            </tr>
            <tr>
                <td><label for="end">ค่าสุดท้าย:</label></td>
                <td><input type="number" id="end" name="end" required></td>
            </tr>
            <tr>
                <td><label for="divisor">ตัวเลขที่นำไปหาร:</label></td>
                <td><input type="number" id="divisor" name="divisor" required></td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                    <button type="submit">Check Num</button>
                </td>
            </tr>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <tr>
                    <td><strong>ตัวเลขที่หารลงตัว:</strong></td>
                    <td><?php echo implode(", ", $numbers); ?></td>
                </tr>
                <tr>
                    <td><strong>จำนวนตัวเลขที่หารลงตัว:</strong></td>
                    <td><?php echo $count; ?></td>
                </tr>
                <tr>
                    <td><strong>ผลรวมของตัวเลขที่หารลงตัว:</strong></td>
                    <td><?php echo $total; ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </form>
</body>
</html>

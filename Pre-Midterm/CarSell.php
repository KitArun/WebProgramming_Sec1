<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Sell</title>
</head>
<body>
    <?php
    // ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // รับค่าจากฟอร์มและตรวจสอบความถูกต้อง
        $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
        $payment_per_installment = isset($_POST['payment_per_installment']) ? $_POST['payment_per_installment'] : 0;
        $installment_count = isset($_POST['installment_count']) ? $_POST['installment_count'] : 0;

        // ตรวจสอบว่าข้อมูลที่รับมาถูกต้อง
        if (empty($customer_name) || $payment_per_installment <= 0 || $installment_count <= 0) {
            echo "<p>ข้อมูลไม่ถูกต้อง กรุณากรอกใหม่</p>";
        } else {
            // คำนวณยอดรวมเงิน
            $total_payment = $payment_per_installment * $installment_count;

            // ตารางราคารถยนต์
            $cars = [
                "Jazz" => 749000,
                "City" => 749000,
                "Civic" => 1149000,
                "Accord" => 1799000,
            ];

            // ฟังก์ชันตรวจสอบรถที่สามารถซื้อได้
            function carCheck($total_payment, $cars) {
                $available_cars = [];
                foreach ($cars as $car_model => $price) {
                    if ($total_payment >= $price) {
                        $available_cars[] = [
                            "model" => $car_model,
                            "price" => $price,
                        ];
                    }
                }
                return $available_cars;
            }

            // เรียกใช้ฟังก์ชัน carCheck
            $available_cars = carCheck($total_payment, $cars);

            // แสดงข้อมูลลูกค้าและรุ่นรถยนต์ในตารางเดียว
            echo "<table border='1' width='1000px' style='margin: 0 auto;'>
                    <tr>
                        <th width='70%' align='left'>ชื่อลูกค้า</th>
                        <td width='30%'>$customer_name</td>
                    </tr>
                    <tr>
                        <th width='70%' align='left'>ผ่อนงวดละ</th>
                        <td width='30%'>" . number_format($payment_per_installment) . " บาท</td>
                    </tr>
                    <tr>
                        <th width='70%' align='left'>จำนวนงวด</th>
                        <td width='30%'>$installment_count งวด</td>
                    </tr>
                    <tr>
                        <th width='70%' align='left'>ยอดรวมเงิน</th>
                        <td width='30%'>" . number_format($total_payment) . " บาท</td>
                    </tr>";
            
            // แสดงผลรุ่นรถยนต์ที่สามารถซื้อได้
            if (empty($available_cars)) {
                echo "<tr>
                        <td colspan='2'>ยอดเงินของท่านไม่เพียงพอที่จะซื้อรถยนต์ได้</td>
                      </tr>";
            } else {
                echo "<tr><th colspan='2' align='left'>รถยนต์ที่ท่านสามารถเลือกซื้อได้</th></tr>";
                foreach ($available_cars as $car) {
                    $model = $car['model'];
                    $price = number_format($car['price']);
                    echo "<tr>
                            <td width='70%'><img src='images/$model.png' alt='$model' width='300'></td>
                            <td width='30%' align='left'>$model - $price บาท</td>
                          </tr>";
                }
            }
            
            // แสดงปุ่มกลับไปหน้าหลัก
            echo "<tr>
                    <td colspan='2' align='center'>
                        <a href='CarPay.php'><button type='button'>Back to Home</button></a>
                    </td>
                  </tr>";
            echo "</table>";
        }
    } else {
        echo "<p>กรุณากรอกฟอร์มก่อน</p>";
    }
    ?>
</body>
</html>

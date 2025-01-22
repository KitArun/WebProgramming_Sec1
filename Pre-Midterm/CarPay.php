<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Pay</title>
</head>
<body>
    <form action="CarSell.php" method="post">
        <table border="1" style="margin: 0 auto;">
            <tr>
                <td><label>ชื่อ-นามสกุล ลูกค้า:</label></td>
                <td><input type="text" name="customer_name" required></td>
            </tr>
            <tr>
                <td><label>จำนวนเงินที่ต้องการผ่อน ต่อ 1 งวด:</label></td>
                <td><input type="number" name="payment_per_installment" required></td>
            </tr>
            <tr>
                <td><label>จำนวนงวด ที่ต้องการ:</label></td>
                <td>
                    <select name="installment_count" required>
                        <option value="36">36 งวด</option>
                        <option value="48">48 งวด</option>
                        <option value="60">60 งวด</option>
                        <option value="72">72 งวด</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">ซื้อรถ</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<html>

<head>
    <title>โปรแกรมรับค่าจากฟอร์มแบบ GET</title>
</head>

<body>
    <?php
    // Get form values
    $number1 = isset($_GET['number1']) ? $_GET['number1'] : 0;
    $number2 = isset($_GET['number2']) ? $_GET['number2'] : 0;
    $operator = isset($_GET['operator']) ? $_GET['operator'] : '';

    // Display the input values
    echo "<p>";
    echo "<b>ข้อมูลผู้ใช้ใส่มา </b><br />";
    echo "Number 1 : <i> $number1 </i> <br/>";
    echo "Number 2 : <i> $number2 </i> <br/>";
    echo "Operator : <i> $operator </i> <br/>";
    echo "Result : <i> ";

    // Check if the numbers and operator are valid
    if (is_numeric($number1) && is_numeric($number2)) {
        if ($operator == "+") {
            echo ($number1 + $number2);
        } elseif ($operator == "-") {
            echo ($number1 - $number2);
        } elseif ($operator == "*") {
            echo ($number1 * $number2);
        } elseif ($operator == "/") {
            if ($number2 != 0) {
                echo ($number1 / $number2);
            } else {
                echo "Cannot divide by zero.";
            }
        } elseif ($operator == "%") {
            echo ($number1 % $number2);
        } else {
            echo "Invalid operator.";
        }
    } else {
        echo "Please enter valid numeric values.";
    }

    echo " </i> <br/>";
    ?>
    <tr>
        <td colspan="1" align="center">
            <!--กลับแบบไปลิ้งก่อนหน้า -->
            <!--a href="javascript:history.back()">Back</a>

                <!-- กลับแบบเลือก -->
            <!--form action="Lab5-9.php"-->
                <input type="submit" value="Back" onclick="javascript:history.back()">
        </td>
    </tr>
    </table>
</body>

</html>
<?php
if (isset($_POST['submit'])) {

    $number1 = isset($_POST['number1']) ? $_POST['number1'] : 0;
    $number2 = isset($_POST['number2']) ? $_POST['number2'] : 0;
    $operator = isset($_POST['operator']) ? $_POST['operator'] : '';

    // Display the input values
    echo "<p>";
    echo "<b>ข้อมูลผู้ใช้ใส่มา </b><br />";
    echo "Number 1 : <i> $number1 </i> <br/>";
    echo "Number 2 : <i> $number2 </i> <br/>";
    echo "Operator : <i> $operator </i> <br/>";
    echo "Result : <i> ";

    // Check if the numbers and operator are valid
    if (is_numeric($number1) && is_numeric($number2) ) {
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
    
    echo '<form action="javascript:history.back()"><input type="submit" value="Back"></form>';

} else {?>
    <html>
    <head>
        <title>การสร้างฟอร์มในการรับค่าเพื่อคำนวณ</title>
    </head>
    
    <body>
        <form method="post" action="lab5-9AllinOne.php">  <!-- Changed method to POST -->
            <table border="1" align="center" width="500">
                <tr>
                    <td colspan="2" align="center">
                        <big>ทดสอบการใช้ Arithmatic Operator </big>
                    </td>
                </tr>
                <tr>
                    <td>Enter Number 1 : </td>
                    <td><input type="number" name="number1" size="15" min="0" max="255" value="" /> </td>
                </tr>
                <tr>
                    <td>Enter Number 2 : </td>
                    <td><input type="number" name="number2" size="15" value="" /></td>
                </tr>
                <tr>
                    <td> Operator : </td>
                    <td align="center">
                        <input type="radio" name="operator" value="+"> + <br>
                        <input type="radio" name="operator" value="-"> - <br>
                        <input type="radio" name="operator" value="*"> * <br>
                        <input type="radio" name="operator" value="/"> / <br>
                        <input type="radio" name="operator" value="%"> % <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value=" OK " />
                        <input type="reset" name="reset" value=" Clear " />
                    </td>
                </tr>
            </table>
        </form>
    </body>
    </html>
<?php
}
?>

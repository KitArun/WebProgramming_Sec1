<html>

<head>
    <title>การสร้างฟอร์มในการรับค่าเพื่อคำนวณ</title>
</head>

<body>
    <form method="get" action="lab5-9cal2.php">
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
                <td><input type="text" name="number2" size="15" value="" /></td>
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
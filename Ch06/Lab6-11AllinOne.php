<?php
if (isset($_GET['submit'])) {

    $hw = $_GET['hw'];
    $midterm = $_GET['midterm'];
    $final = $_GET['final'];
    
    if ($hw > 30) { echo "คะแนนต้องไม่เกิน30"; exit;};
    if ($midterm > 35) { echo "คะแนนต้องไม่เกิน30"; exit;};
    if ($final > 35) { echo "คะแนนต้องไม่เกิน30"; exit;};

    echo "<p>";
    echo "<b>ข้อมูลคะแนน </b><br />";
    echo "Homework : <i> $hw </i> <br/>";
    echo "Midterm : <i> $midterm </i> <br/>";
    echo "Final : <i> $final </i> <br/>";

    $total = $hw + $midterm + $final;
    echo "Total Score : $total <br>";

    if ($total >= 80)
        echo "Result Grade : A<br>";
    elseif ($total >= 75)
        echo "Result Grade : B+<br>";
    elseif ($total >= 70)
        echo "Result Grade : B<br>";
    elseif ($total >= 65)
        echo "Result Grade : C+<br>";
    elseif ($total >= 60)
        echo "Result Grade : C<br>";
    elseif ($total >= 55)
        echo "Result Grade : D+<br>";
    elseif ($total >= 50)
        echo "Result Grade : D<br>";
    else
        echo "Result Grade : F<br>";

    echo "<br>";
    echo "<a href='Lab6-11AllinOne.php'> <big>Back </big></a>";
} else { ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>การสร้างฟอร์มในการรับค่าเพื่อคำนวณเกรด</title>
    </head>

    <body>
        <form method="get" action="Lab6-11AllinOne.php">
            <table border="1" align="center" width="500">
                <tr>
                    <td colspan="2" align="center">
                        <big>ทดสอบการใช้ Arithmatic Operator </big>
                    </td>
                <tr>
                <tr>
                    <td>Enter Home work : </td> 
                    <td><input type="number" name="hw" size="15" min="0" max="31" value="" /> </td>
                </tr>
                <td>Enter Midterm : </td>
                <td><input type="number" name="midterm" size="15" min="0" max="36" value="" /></td>
                </tr>
                <td>Enter final : </td>
                <td><input type="number" name="final" size="15"  min="0" max="36" value="" /></td>
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
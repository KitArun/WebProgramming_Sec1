<?php
if (isset($_POST['submit'])) {
    $filename = $_POST['filename'];
    if (file_exists($filename)) {
        $text = file($filename);
        echo "<table border='0' cellpadding='10' cellspacing='0' style='text-align: center; vertical-align: middle;'>";
        echo "ผลลัพธ์จากการคำนวณเกรด<tr><th>นักศึกษา</th><th>ทดสอบย่อย</th><th>สอบกลางภาค</th><th>สอบปลายภาค</th><th>รวม 100 คะแนน</th><th>เกรด</th></tr>"; // Table headers

        foreach ($text as $tr_data) {
            $array_word = explode(',', $tr_data); 

            echo "<tr>";

            $student_name = htmlspecialchars(trim($array_word[0]));
            $quiz_score = trim($array_word[1]);
            $midterm_score = trim($array_word[2]);
            $final_score = trim($array_word[3]);

            $total_score = $quiz_score + $midterm_score + $final_score;

            if ($total_score >= 80)
                $grade = 'A';
            elseif ($total_score >= 75)
                $grade = 'B+';
            elseif ($total_score >= 70)
                $grade = 'B';
            elseif ($total_score >= 65)
                $grade = 'C+';
            elseif ($total_score >= 60)
                $grade = 'C';
            elseif ($total_score >= 55)
                $grade = 'D+';
            elseif ($total_score >= 50)
                $grade = 'D';
            else
                $grade = 'F';

                
            echo "<td >" . $student_name . "</td>";
            echo "<td >" . htmlspecialchars($quiz_score) . "</td>";
            echo "<td >" . htmlspecialchars($midterm_score) . "</td>";
            echo "<td >" . htmlspecialchars($final_score) . "</td>";
            echo "<td >" . $total_score . "</td>";
            echo "<td >" . $grade . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "ไม่พบไฟล์ที่ระบุ";
    }
} else { ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>การรับไฟล์</title>
    </head>

    <body>
        <form method="post" action="Grade.php">
            <table align="center" width="500">
                <tr>
                    <td colspan="2" align="center">
                        <big> Score Grade Final</big> </big>
                    </td>
                </tr>
                <tr>
                    <td>File name: </td>
                    <td><input type="text" name="filename" size="40" value="" /> </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value=" SUBMIT " />
                        <input type="reset" name="reset" value=" RESET " />
                    </td>
                </tr>
            </table>
        </form>
    </body>

    </html>
    <?php
}
?>
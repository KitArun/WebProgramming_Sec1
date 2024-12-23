<?php
if (isset($_POST['submit'])) {
    $filename = $_POST['filename'];
    $text = file($filename);
    foreach ($text as $tr_data) {

        $column = 1;
        $array_word = explode(',', $tr_data);

        foreach ($array_word as $key => $value) {
            $value = trim($value);
            if ($column == 1) {
                echo $value;
            }
            else {
                if ($value == 'Robert') echo 'Dick <br>';
                elseif ($value == 'Dick') echo 'Dick<br>';

                if ($value == 'William') echo 'Bill<br>';
                elseif ($value == 'Bill') echo 'William<br>';

                if ($value == 'James') echo 'Jim<br>';
                elseif ($value == 'Jim') echo 'James<br>';

                if ($value == 'John') echo 'Jack<br>';
                elseif ($value == 'Jack') echo 'John<br>';

                if ($value == 'Margaret') echo 'Peggy<br>';
                elseif ($value == 'Peggy') echo 'Margaret<br>';

                if ($value == 'Edward') echo 'Ed<br>';
                elseif ($value == 'Ed') echo 'Edward<br>';
                
                if ($value == 'Sarah') echo 'Sally<br>';
                elseif ($value == 'Sally') echo 'Sarah<br>';

                if ($value == 'Andrew') echo 'Andy<br>';
                elseif ($value == 'Andy') echo 'Andrew<br>';

                if ($value == 'Anthony') echo 'Tony<br>';
                elseif ($value == 'Tony') echo 'Anthony<br>';

                if ($value == 'Deborah') echo 'Debbie<br>';
                elseif ($value == 'Debbie') echo 'Deborah<br>';
    
            }
            $column++;
        }

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
        <form method="post" action="FirstnameNickname.php">
            <table align="center" width="500">
                <tr>
                    <td colspan="2" align="center">
                        <big> FirstnameNickname.php </big> </big>
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
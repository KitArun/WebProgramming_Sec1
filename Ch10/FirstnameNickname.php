<?php
if (isset($_POST['submit'])) {
    $filename = $_POST['filename'];
    $text = file($filename);
    echo "<table border='1' cellpadding='10' cellspacing='2'>"; // Start the table
    echo "<tr><th>No.</th><th>Original Name</th><th>Updated Name</th></tr>"; // Table headers
    
    foreach ($text as $tr_data) {

        $column = 1;
        $array_word = explode(',', $tr_data);

        echo "<tr>"; // Start a new table row

        foreach ($array_word as $key => $value) {
            $value = trim($value);
            if ($column == 1) {
                echo "<td>" . htmlspecialchars($value) . "</td>"; // Display original name in the first column
            }
            else {
                $updated_name = ''; // Variable to store the updated name

                // Mapping and updating names
                if ($value == 'Robert') $updated_name = 'Dick';
                elseif ($value == 'Dick') $updated_name = 'Dick';
                elseif ($value == 'William') $updated_name = 'Bill';
                elseif ($value == 'Bill') $updated_name = 'William';
                elseif ($value == 'Janes') $updated_name = 'Jim';
                elseif ($value == 'Jim') $updated_name = 'James';
                elseif ($value == 'John') $updated_name = 'Jack';
                elseif ($value == 'Jack') $updated_name = 'John';
                elseif ($value == 'Margaret') $updated_name = 'Peggy';
                elseif ($value == 'Peggy') $updated_name = 'Margaret';
                elseif ($value == 'Edward') $updated_name = 'Ed';
                elseif ($value == 'Ed') $updated_name = 'Edward';
                elseif ($value == 'Sarah') $updated_name = 'Sally';
                elseif ($value == 'Sally') $updated_name = 'Sarah';
                elseif ($value == 'Andrew') $updated_name = 'Andy';
                elseif ($value == 'Andy') $updated_name = 'Andrew';
                elseif ($value == 'Anthony') $updated_name = 'Tony';
                elseif ($value == 'Tony') $updated_name = 'Anthony';
                elseif ($value == 'Deborah') $updated_name = 'Debbie';
                elseif ($value == 'Debbie') $updated_name = 'Deborah';

                // If the updated name exists, display it
                echo "<td>" . htmlspecialchars($value) . "</td>";
                echo "<td>" . htmlspecialchars($updated_name) . "</td>";
            }
            $column++;
        }
        echo "</tr>"; // End the table row
    }
    echo "</table>"; // End the table
}
else { ?>
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

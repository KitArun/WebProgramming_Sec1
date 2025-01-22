<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
</head>
<body>
    <?php
    function checkNum($arrNum) {
        $count = 0;
        for ($i = 0; $i < 5;) {
            $x = rand(0, 99);
            if (in_array($x, $arrNum)) {
                echo "<h6>ครั้งที่ " . ++$count . " => " . $x . " ยินดีด้วย คุณมีเลขนี้</h6>";
                $i++; // Increment only when the number matches
            } else {
                echo "<h6>ครั้งที่ " . ++$count . " => " . $x . " ยินดีด้วย คุณไม่มีเลขนี้</h6>";
            }
        }
        echo "<h3 style='color:crimson;' align='center'>คุณจบ BINGO เกมนี้ในครั้งที่ $count </h3>";
    }
    ?>

    <?php
    if (isset($_POST['btn'])) {
        $str = $_POST['numbers'];
        $numbers = unserialize($str);
        ?>
        <table border="1" align="center">
            <tr>
                <td colspan="5" align="center" width="60">Bingo Game</td>
            </tr>
            <tr>
                <?php
                $nLine = 1;
                foreach ($numbers as $ele) {
                    echo "<td align='center' width='60'>" . $ele . "</td>";
                    if ($nLine % 5 == 0) echo "</tr><tr>";
                    $nLine++;
                }
                ?>
            </tr>
            <tr>
                <td colspan="5" align="center" width="60">
                    <form action="#" method="post">
                        <input type="submit" name="btn" value="START">
                        <input type="hidden" name="numbers" value="<?php echo serialize($numbers); ?>">
                    </form>
                </td>
            </tr>
        </table>
        <?php
        checkNum($numbers);
        ?>
    <?php
    } else {
        $numbers = array();
        for ($i = 0; $i < 25; $i++) {
            $numbers[] = rand(0, 99);
        }
        ?>
        <table border="1" align="center">
            <tr>
                <td colspan="5" align="center" width="60">Bingo Game</td>
            </tr>
            <tr>
                <?php
                $nLine = 1;
                foreach ($numbers as $ele) {
                    echo "<td align='center' width='60'>" . $ele . "</td>";
                    if ($nLine % 5 == 0) echo "</tr><tr>";
                    $nLine++;
                }
                ?>
            </tr>
            <tr>
                <td colspan="5" align="center" width="60">
                    <form action="#" method="post">
                        <input type="submit" name="btn" value="START">
                        <input type="hidden" name="numbers" value="<?php echo serialize($numbers); ?>">
                    </form>
                </td>
            </tr>
        </table>
    <?php
    }
    ?>
</body>
</html>

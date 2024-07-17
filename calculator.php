<?php
$num = "";
$result = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['num'])) {
        if ($_POST['num'] == 'c') {
            $num = ''; 
            $result = "";
            setcookie("num", "", time() - 3600, "/");
            setcookie("op", "", time() - 3600, "/");
        } else {
            $num = $_POST['input'] . $_POST['num'];
        }
    }

    if (isset($_POST["op"])) {
        if (!empty($_POST['input'])) {
            $num = $_POST['input'] . " " . $_POST['op'] . " ";
        }
    }

    if (isset($_POST["equal"])) {
        $current_input = $_POST['input'];
        
        try {
            if (strpos($current_input, '/') !== false) {
                $parts = explode('/', $current_input);
                if (count($parts) == 2 && (float)$parts[1] == 0) {
                    $result = "0";
                } else {
                    $result = eval("return " . $current_input . ";");
                }
            } else {
                $result = eval("return " . $current_input . ";");
            }
        } catch (ParseError $e) {
            $result = "Error";
        }
        $num = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="calci.css">
</head>
<body>
    <div class="calc">
        <form action="" method="post">
            <br>
            <input type="text" class="maininput" name="input" value="<?php echo htmlspecialchars($num, ENT_QUOTES, 'UTF-8'); ?>"> <br><br>
            <input type="submit" class="numbtn" name="num" value="7">
            <input type="submit" class="numbtn" name="num" value="8">
            <input type="submit" class="numbtn" name="num" value="9">
            <input type="submit" class="calbtn" name="op" value="+"> <br><br>
            <input type="submit" class="numbtn" name="num" value="4">
            <input type="submit" class="numbtn" name="num" value="5">
            <input type="submit" class="numbtn" name="num" value="6">
            <input type="submit" class="calbtn" name="op" value="-"><br><br>
            <input type="submit" class="numbtn" name="num" value="1">
            <input type="submit" class="numbtn" name="num" value="2">
            <input type="submit" class="numbtn" name="num" value="3">
            <input type="submit" class="calbtn" name="op" value="*"><br><br>
            <input type="submit" class="clear" name="num" value="c">
            <input type="submit" class="numbtn" name="num" value="0">
            <input type="submit" class="equal" name="equal" value="=">
            <input type="submit" class="calbtn" name="op" value="/"><br>
            <h3 style="text-align: center; color: aliceblue; font-family:monospace; font-size: x-large;">CASIO</h3>
        </form>
    </div>
</body>
</html>

<?php // Created by 6439456 ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigung</title>
    <link href="css/form.css" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet">
</head>
<body>
    <?php include("navbar.php") /* Integration of navigation bar */ ?>
    <div class="container content">
        <h2>Entschuldigung Minuten</h2>
        <form action="apology.php" method="GET">
            <input type="hidden"
                name="type" value="minutes">

            <?php include("personalInfos.php") /* Integration of personal Infos */ ?>

            <div class="input-group">
                <h4 class="input-group-caption">Informationen zur Abwesenheit</h4>

                <label for="absenceDate">Abwesenheitsdatum:</label><br>
                <input type="date"
                       id="absenceDate" name="absenceDate"
                       placeholder="z.B. 11.11.2019"
                       value="<?php echo date('Y-m-d'); ?>" required><br>

            <div class="row">
                <div class="col-2 input-field">
                    <label for="time_from">Abwesend von (z.B. 12:05):</label>
                    <input type="time"
                        id="time_from" name="time_from"
<?php
	//	safari specifc regex-pattern for time input
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (stripos($user_agent, 'Safari')) {
        echo 'pattern="(2[0-3])|([0-1]?[0-9]):[0-5][0-9]"';
    }
?>
                         required>
                </div>

                <div class="col-2 input-field">
                    <label for="time_to">Abwesend bis (z.B. 12:05):</label>
                    <input type="time"
                        id="time_to" name="time_to"
<?php
	//	safari specifc regex-pattern for time input
    if (stripos($user_agent, 'Safari')) {
        echo 'pattern="(2[0-3])|([0-1]?[0-9]):[0-5][0-9]"';
    }
?>
                         required>
                </div>
            </div>

                <label for="explanation">Grund:</label><br>
                <input type="text"
                       id="explanation" name="explanation"
                       placeholder="Ich habe die Zeit vergessen" required><br>

                <label for="typeOfDelay">Typ der Verspätung:</label><br>
                <select id="typeOfDelay" name="typeOfDelay">
                    <option value="Ich habe mich <strong>verspätet</strong>" selected>Ich habe mich verspätet</option>
                    <option value="Ich bin <strong>früher gegangen</strong>">Ich bin früher gegangen</option>
                    <option value="Ich bin <strong>später gekommen</strong>">Ich bin später gekommen</option>
                </select><br>
            </div>
            <button class="button round">Erstellen</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigung</title>
    <link href="css/form.css" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet">
</head>
<body>
    <?php include("navbar.php") ?>
    <div class="container content">
        <h2>Entschuldigung Minuten</h2>
        <form action="apology.php" method="GET">
            <input type="hidden"
                name="type" value="minutes">

            <?php include("personalInfos.php") ?>

            <div class="input-group">
                <h4 class="input-group-caption">Informationen zur Abwesenheit</h4>

                <label for="absenceDate">Abwesenheitsdatum:</label><br>
                <input type="date"
                       id="absenceDate" name="absenceDate"
                       placeholder="z.B. 11.11.2019"
                       value="<?php echo date('Y-m-d'); ?>" required><br>

                <div class="row">
                    <div class="col-2 input-field">
                        <label for="time_from">Abwesend von:</label>
                        <input type="time"
                               id="time_from" name="time_from"
                               placeholder="z.B. 8:00, 16:05"
                               pattern="(2[0-3])|([0-1]?[0-9]):[0-5][0-9]" required>
                    </div>

                    <div class="col-2 input-field">
                        <label for="time_to">Abwesend bis:</label>
                        <input type="time"
                               id="time_to" name="time_to"
                               placeholder="z.B. 8:00, 16:05"
                               pattern="(2[0-3])|([0-1]?[0-9]):[0-5][0-9]" required>
                    </div>
                </div>

                <label for="explanation">Grund:</label><br>
                <input type="text"
                       id="explanation" name="explanation"
                       placeholder="Ich habe die Zeit vergessen" required><br>

                <label for="typeOfDelay">Typ der Verspätung:</label><br>
                <select id="typeOfDelay" name="typeOfDelay">
                    <option value="Ich habe mich <strong>verspätet</strong>" selected>Ich habe mich <strong>verspätet</strong></option>
                    <option value="Ich bin <strong>früher gegangen</strong>">Ich bin <strong>früher gegangen</strong></option>
                    <option value="Ich bin <strong>später gekommen</strong>">Ich bin <strong>später gekommen</strong></option>
                </select><br>
            </div>
            <button class="button round">Erstellen</button>
        </form>
    </div>
</body>
</html>

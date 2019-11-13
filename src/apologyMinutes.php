<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigung</title>
    <link href="layout.css" rel="stylesheet">
</head>
<body>
    <h2>Entschuldigung Minuten</h2>
    <form action="apology.php" method="GET">
        <input type="hidden"
            name="type" value="minutes">
        <label for="firstname">Vorname:</label><br>
        <input type="text"
            id="firstname" name="firstname"
            placeholder="Vorname" required><br>

        <label for="lastname">Nachname:</label><br>
        <input type="text"
            id="lastname" name="lastname"
            placeholder="Nachname" required><br>

        <label for="street">Straße:</label><br>
        <input type="text"
            id="street" name="street"
            placeholder="Straße und Hausnummer" required><br>

        <label for="postalCode">PLZ</label><br>
        <input type="text"
            id="postalCode" name="postalCode"
            placeholder="PLZ"
            pattern="[0-9][0-9][0-9][0-9][0-9]" required><br>

        <label for="city">Stadt</label><br>
        <input type="text"
            id="city" name="city"
            placeholder="Stadt" required><br>

        <label for="absenceDate">Abwesenheitsdatum:</label><br>
        <input type="date"
            id="absenceDate" name="absenceDate"
            placeholder="z.B. 11.11.2019"
            value="<?php echo date('d.m.Y'); ?>" required><br>

        <label for="time_from">Abwesend von:</label><br>
        <input type="time"
            id="time_from" name="time_from"
            placeholder="z.B. 8:00, 16:05"
            pattern="(2[0-3])|([0-1]?[0-9]):[0-5][0-9]" required><br>

        <label for="time_to">Abwesend bis:</label><br>
        <input type="time"
            id="time_to" name="time_to"
            placeholder="z.B. 8:00, 16:05"
            pattern="(2[0-3])|([0-1]?[0-9]):[0-5][0-9]" required><br>

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

        <button>Erstellen</button>
    </form>
</body>
</html>

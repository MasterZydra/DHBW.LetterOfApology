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
        <label for="fullname">Vor- und Nachname:</label><br>
        <input type="text"
            id="fullname" name="fullname"
            placeholder="Vor- und Nachname" required><br>

        <label for="street">Straße:</label><br>
        <input type="text"
            id="street" name="street"
            placeholder="Straße und Hausnummer" required><br>

        <label for="postalcode">PLZ:</label><br>
        <input type="text"
            id="postalCode" name="postalCode"
            placeholder="PLZ" required>

        <label for="city">Stadt:</label><br>
        <input type="text"
            id="city" name="city"
            placeholder="Stadt" required>

        <input type="date" name="absenceDate" value="<?php echo date(d.m.Y); ?>">
        <input type="time" name="time_from" placeholder="Abwesend von">
        <input type="time" name="time_to" placeholder="Abwesend bis">
    <button>Erstellen</button>
  </form>
</body>
</html>

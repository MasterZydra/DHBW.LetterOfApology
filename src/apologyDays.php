<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigung für Abwesenheit</title>
    <link href="css/base.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
</head>
<body>
    <?php include("navbar.php") ?>
    <div class="container">
        <h2>Entschuldigung Tage</h2>
        <form action="apology.php" method="GET">
            <input type="hidden"
                name="type" value="days">

            <?php include("personalInfos.php") ?>
            <hr>

            <div class="row">
                <div class="col-2 input-field">
                    <label for="absenceDate">Abwesend von: </label>
                    <input type="date" id="absenceDate" name="absenceDate" value="<?php echo date('Y-m-d'); ?>" >
                </div>

                <div class="col-2 input-field">
                    <label for="missingDays">Anzahl der abwesenden Tage: </label>
                    <input type="number"
                           id="missingDays" name="missingDays"
                           value="1"
                           placeholder="Anzahl der abwesenden Tage" required>
                </div>
            </div>
            <br>
            <label for="explanation">Grund: </label><br>
            <input type="text" id="explanation" name="explanation" placeholder="Ich hatte Bauchschmerzen" required><br>
            
            <button class="button round">Erstellen</button>
          </form>
    </div>
    
    
</body>
</html>

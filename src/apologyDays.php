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
        <form action="apology.php" method="POST">
            <input type="hidden"
                name="type" value="days">
            
            <div class="name">
            <div class="test">
            <label for="firstname">Vorname:</label>
            <input type="text"
                id="firstname" name="firstname"
                placeholder="Vorname" required>
            </div>
            <div class="test">
            <label for="name">Nachname:</label>
            <input type="text"
                id="name" name="name"
                placeholder="Nachname" required>
            </div>
            </div>
            <hr>
            <!--
            <label for="fullname">Vor- und Nachname:</label><br>
            <input type="text"
                id="fullname" name="fullname"
                placeholder="Vor- und Nachname" required><br>
            -->

            <div class="address">
            <label for="street">Straße:</label><br>
            <input type="text"
                id="street" name="street"
                placeholder="Straße und Hausnummer" required><br>

            <div class="test">
            <label for="postalcode">PLZ:</label>
            <input type="text"
                id="postalCode" name="postalCode"
                placeholder="PLZ" required>
                </div>
                
            <div class="test">
            <label for="city">Stadt:</label>
            <input type="text"
                id="city" name="city"
                placeholder="Stadt" required>
                </div>
            </div>
            <hr>
            
            <div class="test">
            <label for="absenceDate">Abwesend von: </label>
            <input type="date" name="absenceDate" value="<?php echo date(d.m.Y); ?>" >
            </div>
            
            <div class="test">
            <label for="missingDays">Anzahl der Abwesenden Tage: </label>
            <input type="number" 
                id="missingDays" name="missingDays" 
                placeholder="Anzahl der Abwesenden Tage" required>
            </div>
            <br>
            <label for="explanation">Grund: </label><br>
            <input type="text" id="explanation" name="explanation" placeholder="Ich hatte Bauchschmerzen" required><br>
            
            <button>Erstellen</button>
          </form>
    </div>
    
    
</body>
</html>

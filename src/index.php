<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigungs-Generator</title>
    <link href="css/base.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <?php include("navbar.php") ?>

    <div class="container content">
        <div class="jumbotron round">
            <h1>Say sorry the right way!</h1>
            <p class="lead">Mit diesem simplen PDF-Generator für Entschuldigungen in der Schule verzeiht dir dein Lehrer garantiert!</p>
            <hr>
            <p>Wähle zuerst deine <strong>Fehlzeit</strong> aus:</p>

            <div class="row">
                <div class="col-2 card round">
                    <h3 class="card-title">(mehrere) Tage</h3>
                    <p>Du hast gleich ein Tag oder sogar mehrere gefehlt?</p>
                    <a href="./apologyDays.php" class="button round">klick hier!</a>
                </div>
                <div class="col-2 card round">
                    <h3 class="card-title">Stunden/Minuten</h3>
                    <p>Du bist "nur" ein paar Stunden oder ein paar Minuten zu spät?</p>
                    <a href="./apologyMinutes.php" class="button round">klick hier!</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

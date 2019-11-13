<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigungs-Generator</title>
    <link href="./ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="./">Entschuldigungs-Generator</a>
        <input type="checkbox" id="navbar-toggle-cbox">
        <label for="navbar-toggle-cbox" class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">
            &#9776;
        </label>
        <div class="collapse navbar-collapse">

            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Fehlzeit: (mehrere) Tage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Fehlzeit: Stunden/Minuten</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Say sorry the right way!</h1>
            <p class="lead">Mit diesem simplen PDF-Generator für Entschuldigungen in der Schule verzeiht dir dein Lehrer garantiert!</p>

            <hr class="my-4">

            <p>Wähle zuerst deine <strong>Fehlzeit</strong> aus:</p>
            <div class="row">
                <div class="col-lg-6 card">
                    <div class="card-body">
                        <h5 class="card-title">(mehrere) Tage</h5>
                        <p class="card-text">Du hast gleich ein Tag oder sogar mehrere gefehlt?</p>
                        <a href="./index.php" class="btn btn-primary stretched-link">klick hier!</a>
                    </div>
                </div>
                <div class="col-lg-6 card">
                    <div class="card-body">
                        <h5 class="card-title">Stunden/Minuten</h5>
                        <p class="card-text">Du bist nur ein paar Stunden oder ein paar Minuten zu spät?</p>
                        <a href="./index.php" class="btn btn-primary stretched-link">hier entlang!</a>
                    </div>
                </div>
            </div>
<!--            <ul>-->
<!--                <li><a href="./index.php">(mehrere) Tage</a></li>-->
<!--                <li><a href="./index.php">Stunden/Minuten</a></li>-->
<!--            </ul>-->
<!--            <form action="./route.php">-->
<!--                <div class="form-row">-->
<!--                    <div class="col-auto">-->
<!--                        <select class="form-control" id="chooseMissingType">-->
<!--                            <option>(mehrere) Tage</option>-->
<!--                            <option>Stunden/Minuten</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="col-auto">-->
<!--                        <button type="submit" class="btn btn-primary ">Weiter</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->

        </div>
    </div>
</body>
</html>

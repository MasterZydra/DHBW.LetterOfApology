<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/base.css" rel="stylesheet">
    <link href="admin.css" rel="stylesheet">
</head>
<body>
<?php
    // Set variable level to go one level up to index.php
    $level = 1;
    include("../navbar.php");
?>
        <div class="container content">
            <form action="" method="POST">
                Wollen Sie die Datei wirklich löschen?
            </form>
            <a href=''>
                <button class='button round'>Ja</button>
            </a>
            <a href='index.php?folder=<?php
    echo $_GET['folder'];
    if (isset($_GET['sort'])) echo "&sort=$_GET[sort]";
            ?>'>
                <button class='button round'>Nein</button>
            </a>
        </div>
    </body>
</html>

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
    if (!isset($_GET["delete"])) {
?>
    <div class="container content">
        <form action="" method="POST">
            Wollen Sie die Datei wirklich löschen?
        </form>
        <a href='deleteMessage.php?delete=1&folder=<?php
            echo $_GET['folder'];
            echo "&file=$_GET[file]";
            if (isset($_GET['sort'])) echo "&sort=$_GET[sort]";
        ?>'>
            <button class='button round'>Ja</button>
        </a>
        <a href='index.php?folder=<?php
            echo $_GET['folder'];
            if (isset($_GET['sort'])) echo "&sort=$_GET[sort]";
        ?>'>
            <button class='button round'>Nein</button>
        </a>
    </div>
<?php
    } else {
        if (!isset($_GET['file'])) {
            echo "File not given!";
        }
        if (!unlink($_GET['file'])) {  
            echo ("$_GET[file] cannot be deleted due to an error");  
        }
        
        $dest = "index.php?folder=$_GET[folder]&sort=$_GET[sort]";
        header("Location: " . $dest);
        exit();
    }     
?>
</body>
</html>

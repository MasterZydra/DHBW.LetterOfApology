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
            <button class='button round deleteButton'>Ja</button>
        </a>
        <a href='index.php?<?php
            if (is_file($_GET['file'])) echo "folder=$_GET[file]";
            if (isset($_GET['sort']))   echo "&sort=$_GET[sort]";
        ?>'>
            <button class='button round'>Nein</button>
        </a>
    </div>
<?php
    } else {
        if (!isset($_GET['file'])) {
            echo "File not given!";
        }
        
        
        $dest = "index.php?";
        if (is_file($_GET['file'])) $dest .= "folder=$_GET[folder]";
        if (isset($_GET['sort']))   $dest .= "&sort=$_GET[sort]";
        
        deleteDirectory($_GET['file']);
        
        header("Location: " . $dest);
        exit();
    }

/* 
 * php delete function that deals with directories recursively
 */
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
?>
</body>
</html>

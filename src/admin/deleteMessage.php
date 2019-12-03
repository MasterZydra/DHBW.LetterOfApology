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
    // If delete parameter is not set, show question
    if (!isset($_GET["delete"])) {
?>
    <div class="container content">
        <form action="" method="POST">
            Wollen Sie <?php
            // Show file/folder depending on type
            echo is_file($_GET['file']) ? "die Datei" : "das Verzeichnis";
            ?> wirklich löschen?
        </form>
        <a href='deleteMessage.php?delete=1&amp;folder=<?php
            // Build return address with folder and file parameter to delete a file/folder
            echo $_GET['folder'];
            // Add file to URL
            echo "&file=$_GET[file]";
            // If it was set, add sort param to return address
            if (isset($_GET['sort'])) echo "&amp;sort=$_GET[sort]";
        ?>'>
            <button class='button round deleteButton'>Ja</button>
        </a>
        <a href='index.php?<?php
            // If is file, add folder to return address
            if (is_file($_GET['file'])) echo "folder=$_GET[folder]";
            // If sort was set, add sort param to return address
            if (isset($_GET['sort']))   echo "&sort=$_GET[sort]";
        ?>'>
            <button class='button round'>Nein</button>
        </a>
    </div>
<?php
    } else {
        if (isset($_GET['file'])) {
            // Build destination before deleting the folder and its files
            $dest = "index.php?";
            // Add parameter folder to return address only if it is a file
            if (is_file($_GET['file'])) $dest .= "folder=$_GET[folder]";
            // Add sort parameter if it was set
            if (isset($_GET['sort']))   $dest .= "&amp;sort=$_GET[sort]";
            // Delete the directory
            deleteDirectory($_GET['file']);
        }
        // Go back to folder view
        header("Location: " . $dest);
        exit();
    }

    // Delete all files and folders in given directory with itself included
    function deleteDirectory($dir) {
        // Leave if file/directory does not exist
        if (!file_exists($dir)) return;
        // If file then delete file
        if (!is_dir($dir)) unlink($dir);
        // Go throw sub directories and clear/delete them
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            deleteDirectory($dir . DIRECTORY_SEPARATOR . $item);
        }
        // Delete the directory
        rmdir($dir);
    }
?>
</body>
</html>

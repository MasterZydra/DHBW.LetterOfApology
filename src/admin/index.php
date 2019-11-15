<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <link href="admin.css" rel="stylesheet">
        <link href="../css/base.css" rel="stylesheet">
    </head>
    <body>
<?php
    // Set variable level to go one level up to index.php
    $level = 1;
    include("../navbar.php");
?>
        <div class="container content">

            <?php 
            $directory = "PDFs/";
            
            echo "<div class='button-row'>";
            
            if(isset($_GET["folder"])) {
                $directory .= $_GET["folder"];
                $backUrl = "./";
            } else{
                $backUrl = "../";
            }
            echo "<a href='$backUrl'><button class='button round'>Zurück</button></a>";

            echo "<form method='get'>";
            
            if(isset($_GET["folder"])) {
                echo "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>";
            }
        
            echo "<input type='hidden'
                name='sort' value=";
            if(isset($_GET["sort"]) && $_GET["sort"] == "ASC") {
                echo "'DESC'";
            }
            else {
                echo "'ASC'";
            }
            echo ">
                <button class='button round'>";
            if(isset($_GET["sort"]) && $_GET["sort"] == "ASC") {
                echo "Absteigend sortieren";
            }
            else {
                echo "Aufsteigend sortieren";
            }
            echo "</button>
                </form>";
        
            echo "</div>";

            $directoryHandle = dir($directory);
        
            $folders = [];
            $files = [];
        
            while(($file = $directoryHandle->read()) !== false) {
                if($file != "." && $file != "..") {
                    if(!isset($_GET["folder"]) && is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        $folders[] = $file;
                    }
                    if(isset($_GET["folder"]) && !is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        $files[] = $file;
                    }
                }
            }
        
            if (!isset($_GET["folder"])) {
                if (isset($_GET["sort"]) && $_GET["sort"] == "DESC") {
                    arsort($folders);
                }
                else {
                    asort($folders);
                }
                foreach($folders as $folder) {
                    echo "<a class='list-item' href='?folder=$folder'>$folder</a><br>";
                }
            }
            else {
                if (isset($_GET["sort"]) && $_GET["sort"] == "DESC") {
                    arsort($files);
                }
                else {
                    asort($files);
                }
                foreach($files as $file) {
                    echo "<a class='list-item' href='$directory/$file' target='_blank'>$file</a><br>";
                }
            }

            $directoryHandle->close();
            ?>

        </div>
    </body>
</html>
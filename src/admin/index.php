<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="admin.css" rel="stylesheet">
    </head>
    <body>
        <?php include("../navbar.php") ?>
        <div class="container">

            <?php 
            $directory = "PDFs/";

            if(isset($_GET["folder"])) {
                $directory .= $_GET["folder"];
            }

            $directoryHandle = dir($directory);

            while(($file = $directoryHandle->read()) !== false) {
                if($file != "." && $file != "..") {
                    if(!isset($_GET["folder"]) && is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        echo "<a href='?folder=$file'>$file</a><br>";
                    }
                    if(isset($_GET["folder"]) && !is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        echo "<a href='$directory/$file' target='_blank'>$file</a><br>";
                    }
                }
            }

            $directoryHandle->close();
            ?>

        </div>
    </body>
</html>
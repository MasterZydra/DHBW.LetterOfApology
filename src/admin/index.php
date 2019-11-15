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
                        $files[filemtime($directory.DIRECTORY_SEPARATOR.$file)] = $file;
                    }
                }
            }
        
        
        echo "<div class='list'><table><tr><th>Name";
        echo "<form method='get'>";
        if(isset($_GET["folder"])) {
                echo "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>";
            }
        echo "<input type='hidden' name='sort' value='";
        if(isset($_GET["sort"]) && $_GET["sort"] == "ASC") {
            echo "DESC";
        }
        else {
            echo "ASC";
        }
        echo "'><button class='button round'>	
&#9207;</button></form>";
        echo "</th><th>Letzte Änderung";
        echo "<form method='get'>";
        if(isset($_GET["folder"])) {
                echo "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>";
            }
        echo "<input type='hidden' name='sort' value='";
        if(isset($_GET["sort"]) && $_GET["sort"] == "ASCDate") {
            echo "DESCDate";
        } else {
            echo "ASCDate";
        }
        echo "'><button class='button round'>	
&#9207;</button></form>";
        echo "</th></tr>";
            if (!isset($_GET["folder"])) {
                if (isset($_GET["sort"]) && $_GET["sort"] == "DESC") {
                    arsort($folders);
                } else {
                    asort($folders);
                }
                foreach($folders as $folder) {
                    echo "<tr><td><a class='list-item' href='?folder=$folder'>$folder</a></td></tr>";
                }
            }
            else {
                if (isset($_GET["sort"]) && $_GET["sort"] == "DESC") {
                    arsort($files);
                } elseif (isset($_GET["sort"]) && $_GET["sort"] == "ASCDate") {
                    ksort($files);
                } else if (isset($_GET["sort"]) && $_GET["sort"] == "DESCDate") {
                    krsort($files);
                } else {
                    asort($files);
                }    
                $keys = array_keys($files);
                foreach($keys as $key) {
                    echo "<tr><td><a class='list-item' href='$directory/$files[$key]' target='_blank'>$files[$key]</a></td><td>".date("d.m.Y", $key)."</td></tr>";
                }
            }

        echo "</table></div>";
            
            $directoryHandle->close();
            ?>

        </div>
    </body>
</html>
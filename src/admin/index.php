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
            function cmpFunc($a, $b) {
                return $a[1] > $b[1];
            }
            
            function cmpFuncDesc($a, $b) {
                return $a[1] < $b[1];
            }
            
            $directory = "PDFs/";
            
            if(isset($_GET["folder"])) {
                $directory .= $_GET["folder"];
                $backUrl = "./";
            } else{
                $backUrl = "../";
            }
            
            $directoryHandle = dir($directory);
        
            $folders = [];
            $files = [];
        
            while(($file = $directoryHandle->read()) !== false) {
                if($file != "." && $file != "..") {
                    if(!isset($_GET["folder"]) && is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        $folders[filemtime($directory.DIRECTORY_SEPARATOR.$file)] = [$file, count(scandir($directory.$file))-2];
                    }
                    if(isset($_GET["folder"]) && !is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        $files[filemtime($directory.DIRECTORY_SEPARATOR.$file)] = $file;
                    }
                }
            }
            
            echo "<div class='button-row'>
                    <a href='$backUrl'>
                        <button class='button round'>Zurück</button>
                    </a>
                </div>";
        
            echo "<div class='list'><table><tr><th>Name
                <form method='get'>";
            // save given parameters in form
            echo (isset($_GET["folder"])) ? "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>" : "";

            echo "<input type='hidden' name='sort' value='";
            
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASC") ? "DESC" : "ASC";

            echo "'><button class='button round'>";
            
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASC") ? "&#9206;" : "&#9207;";
            
            echo "</button></form>
                </th><th>Letzte Änderung";
            echo "<form method='get'>";
            
            echo (isset($_GET["folder"])) ? "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>" : "";
            
            echo "<input type='hidden' name='sort' value='";
            
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASCDate") ? "DESCDate" : "ASCDate";
            

            echo "'><button class='button round'>";
            
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASC") ? "&#9206;" : "&#9207;";

            echo "</button></form>";
            echo "</th>";
                if (!isset($_GET["folder"])) {
                    echo "<th>Anzahl der Entschuldigungen";
                    echo "<form method='get'>";
                    echo "<input type='hidden' name='sort' value='";
                    if(isset($_GET["sort"]) && $_GET["sort"] == "ASCCount") {
                        echo "DESCCount";
                    }
                    else {
                        echo "ASCCount";
                    }
                    echo "'><button class='button round'>";
                    if(isset($_GET["sort"]) && $_GET["sort"] == "ASCCount") {
                        echo "&#9206;";
                    } else {
                        echo "&#9207;";
                    }
                    echo "</button></form>";
                    echo "</th></tr>";
                    
                    if (isset($_GET["sort"])) {
                        switch ($_GET["sort"]) {
                            case "DESC":        arsort($folders); break;
                            case "ASCDate":     ksort($folders); break;
                            case "DESCDate":    krsort($folders); break;
                            case "ASCCount":    uasort($folders, 'cmpFunc'); break;
                            case "DESCCount":   uasort($folders, 'cmpFuncDesc'); break;
                            default:            asort($folders);
                        }
                    }

                    $keys = array_keys($folders);
                    foreach($keys as $key) {
                        $folder = $folders[$key];
                        echo "<tr><td><a class='list-item' href='?folder=$folder[0]'>$folder[0]</a></td><td>".date("d.m.Y", $key)."</td><td>$folder[1]</td></tr>";
                    }
                }
                else {
                    echo "</tr>";
                    if(isset($_GET["sort"])) {
                        switch ($_GET["sort"]) {
                            case "DESC":        arsort($files); break;
                            case "ASCDate":     ksort($files); break;
                            case "DESCDate":    krsort($files); break;
                            default:            asort($files); break;
                        }
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

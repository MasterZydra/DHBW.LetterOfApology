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

            <?php 
            // function to sort a multidimensional array by the second value of the inner array (e.g. number of the files)
            function cmpFunc($a, $b) {
                return $a[1] > $b[1];
            }
            
            // function to sort a multidimensional array descending by the second value of the inner array (e.g. number of the files)
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
                    // check if you are not in the view of a folder and file is folder
                    if(!isset($_GET["folder"]) && is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        // save folder and number of files in the folder in array $folders, with key: last change time
                        $folders[filemtime($directory.DIRECTORY_SEPARATOR.$file)] = [$file, count(scandir($directory.$file))-2];
                    }
                    // check if you are in the view of a folder and file is not folder
                    if(isset($_GET["folder"]) && !is_dir($directory.DIRECTORY_SEPARATOR.$file)) {
                        // save filename in array $files, with key: last change time
                        $files[filemtime($directory.DIRECTORY_SEPARATOR.$file)] = $file;
                    }
                }
            }
            
            echo "<div class='button-row'>
                    <a href='$backUrl'>
                        <button class='button round'>Zurück</button>
                    </a>
                </div>";
        
//            echo "<div class='list'><table><tr><th>Name
            echo "<div class='list'><table><tr><th>Name
                <form method='get'>";
            // save given parameters in form
            echo (isset($_GET["folder"])) ? "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>" : "";

            echo "<input type='hidden' name='sort' value='";
            
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASC") ? "DESC" : "ASC";

            echo "'><button class='button round'>";
            // depending on the sorting, a different arrow is displayed (ascending or descending)
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASC") ? "&#11105;" : "&#11107;";
            
            echo "</button></form>
                </th><th>Letzte Änderung";
            echo "<form method='get'>";
            // save given parameters in form
            echo (isset($_GET["folder"])) ? "<input type ='hidden' name='folder' value='".$_GET["folder"]."'>" : "";
            
            echo "<input type='hidden' name='sort' value='";
            
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASCDate") ? "DESCDate" : "ASCDate";
            

            echo "'><button class='button round'>";
            // depending on the sorting, a different arrow is displayed (ascending or descending)
            echo (isset($_GET["sort"]) && $_GET["sort"] == "ASCDate") ? "&#11105;" : "&#11107;";

            echo "</button></form>";
            echo "</th>";
                if (!isset($_GET["folder"])) {
                    echo "<th>Anzahl der Entschuldigungen";
                    echo "<form method='get'>";
                    // save given parameters in form
                    echo "<input type='hidden' name='sort' value='";
                    echo (isset($_GET["sort"]) && $_GET["sort"] == "ASCCount") ? "DESCCount"  : "ASCCount";
                    echo "'><button class='button round'>";
                    // depending on the sorting, a different arrow is displayed (ascending or descending)
                    echo (isset($_GET["sort"]) && $_GET["sort"] == "ASCCount") ? "&#11105;" : "&#11107;";
                    echo "</button></form>";
                    echo "</th></tr>";
                    
                    if (isset($_GET["sort"])) {
                        // sort array
                        switch ($_GET["sort"]) {
                            case "DESC":        arsort($folders); break; // descending sorted by title
                            case "ASCDate":     ksort($folders); break; // ascending sorted by last change time (key)
                            case "DESCDate":    krsort($folders); break; // descending sorted by last change time (key)
                            case "ASCCount":    uasort($folders, 'cmpFunc'); break; // ascending sorted by number of documents
                            case "DESCCount":   uasort($folders, 'cmpFuncDesc'); break; // descending sorted by number of documents
                            default:            asort($folders); // ascending sorted by title
                        }
                    }

                    $keys = array_keys($folders);
                    foreach($keys as $key) {
                        $folder = $folders[$key];
                        echo "<tr class='item-row'>
                                <td><a class='list-item' href='?folder=$folder[0]'>$folder[0]</a></td>
                                <td>".date("d.m.Y", $key)."</td>
                                <td>$folder[1]</td>";
                                                // Delete Button
                        echo "<td><a class='button deleteButton' href='deleteMessage.php?folder=$directory$folder[0]";
                        if (isset($_GET["sort"])) echo "&sort=$_GET[sort]";
                        echo "&file=$directory$folder[0]";
                        echo "'>Löschen</a></td>";
                        
                        echo "</tr>"; // name of the folder, last change time and number of documents are displayed for each element in the array $folders
                    }
                }
                else {
                    echo "</tr>";
                    if(isset($_GET["sort"])) {
                        switch ($_GET["sort"]) {
                            case "DESC":        arsort($files); break; // descending sorted by title
                            case "ASCDate":     ksort($files); break; // ascending sorted by last change time (key)
                            case "DESCDate":    krsort($files); break; // descending sorted by last change time (key)
                            default:            asort($files); break; // ascending sorted by title
                        }
                    }
                    
                    $keys = array_keys($files);
                    foreach($keys as $key) {
                        echo "<tr class='item-row'>
                                <td><a class='list-item' href='$directory/$files[$key]' target='_blank'>$files[$key]</a></td>
                                <td>".date("d.m.Y", $key)."</td>";
                        // Delete Button
                        echo "<td><a class='button deleteButton' href='deleteMessage.php?folder=$_GET[folder]";
                        if (isset($_GET["sort"])) echo "&sort=$_GET[sort]";
                        echo "&file=" . $directory . "/" . $files[$key];
                        echo "'>Löschen</a></td>";
                        
                        echo "</tr>"; // name of the file and last change time are displayed for each element in the array $files
                    }
                }

            echo "</table></div>";

                $directoryHandle->close();
            ?>

        </div>
    </body>
</html>

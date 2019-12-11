<?php // Created by 9752762 ?>

<?php
    /*
     * Create string with levels of directories that need
     * to be go back to get to index.php
     */
    function getBackPath($level) {
        // Define empty string as default value
        $ret = "";
        // Check if variable $level is set
        if (isset($level)) {
            // For each level add "/.." to return string
            for ($i = 0; $i < $level; $i++) {
                $ret .= "/..";
            }
        }
        // Return string that can be inserted into a file path
        return $ret;
    }
?>
<nav class="navbar">
    <div class="container">
        <div>
            <a class="navbar-title" href=".<?php echo isset($level) ? getBackPath($level) : ""; ?>/"><h1>Entschuldigungs-Generator</h1></a>
        </div>
        <?php
            // remove everything after '?' in URL if it exists
            $url = $_SERVER['REQUEST_URI'];
            $url = strpos($url, "?") ? substr($url, 0, strpos($url, "?")) : $url;

            // save url parts in array and remove last empty array item
            $urlArray = explode("/", $url);
            array_pop($urlArray);

            // reverse the order of the array and return the value of the first item
            $lastFolderInUrl = array_values(array_slice($urlArray, -1))[0];
            if ($lastFolderInUrl != "admin") {
                // only show admin button if you are not in the admin space
                echo "<div><a class='button round admin-button' href='admin/'>Admin</a></div>";
            }
        ?>
    </div>
</nav>

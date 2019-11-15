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
            <a class="navbar-title" href=".<? php echo getBackPath($level); ?>/"><h1>Entschuldigungs-Generator</h1></a>
        </div>
        <div>
            <a class="button round admin-button" href="admin/">Admin</a>
        </div>
    </div>
</nav>

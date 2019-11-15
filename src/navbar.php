<nav class="navbar">
    <div class="container">
        <div>
            <a class="navbar-title" href="./"><h1>Entschuldigungs-Generator</h1></a>
        </div>
        <div>
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
                echo "<a class='button round admin-button' href='admin/'>Admin</a>";
            }
        ?>
        </div>
    </div>
</nav>
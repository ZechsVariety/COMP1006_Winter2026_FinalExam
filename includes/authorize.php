<?php
    //"Prevent standard browser/proxy caching" or something
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

    //check if there's a valid session
    if (empty($_SESSION["id"])) {
        header("Location: ./restricted.php");
        exit;
    }
?>

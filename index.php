<?php
    require "includes/connect.php";

    if(isset($_SESSION["email"])) {
        echo("<p>hi, <em>" . $_SESSION["email"] . "</em></p>");
    }
    else {
        echo("<p>hi</p>");
    }

    include "includes/footer.php";
?>

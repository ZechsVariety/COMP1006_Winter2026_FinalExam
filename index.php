<?php
    require "includes/connect.php";

    if(isset($_SESSION["email"])) {
        echo("<p>Logged in as <em>" . $_SESSION["email"] . "</em></p>
            <a href='logout.php'>Logout</a>");
    }
    else {
        echo("<p>hi</p>
            <a href='login.php'>Login</a>
            <a href='register.php'>Register</a>");
    }

    include "includes/footer.php";
?>

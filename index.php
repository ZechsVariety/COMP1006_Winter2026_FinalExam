<?php
    require "includes/connect.php";

    if(isset($_SESSION["username"])) {
        echo("<p>hi, <em>" . $_SESSION["username"] . "</em></p>
            <a href='logout.php'>Logout</a>");
    }
    else {
        echo("<p>hi</p>
            <a href='login.php'>Login</a>
            <a href='register.php'>Register</a>");
    }

    include "includes/footer.php";
?>

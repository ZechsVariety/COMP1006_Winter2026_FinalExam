<?php
    require "includes/connect.php";
    require "includes/authorize.php";

    //clear global session variables
    $_SESSION = [];

    //clear session variable values from memory
    session_unset();

    //destroy the session
    session_destroy();

    //redirect
    header("Location: login.php");

    exit;
?>

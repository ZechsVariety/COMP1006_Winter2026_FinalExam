<?php
    require "includes/connect.php";

    $errors = [];
    $success = "";

    //form submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //grab form data
        $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
        $password = $_POST["password"] ?? "";
    
        //validate

        //email

        //blank
        if($email == "") {
            $errors[] = "Please enter an email.";
        }
        //format
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "'" . $email . "' is an invalid email address.";
        }

        //password

        //blank
        if($password == "") {
            $errors[] = "Please enter a password.";
        }

    }

    //display errors
    if(!empty($errors)) {
        echo("<h2>ERROR:</h2>
            <ul>");
        
        foreach($errors as $error) {
            echo("<li>" . $error . "</li>");
        }

        echo("</ul>");
    }

    if($success != "") {
        echo("<h2>Success!</h2>
            <p>" . $success . "</p>");
    }
?>

<h1>Login</h1>

<form id="loginForm" method="post">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="login.php">Register</a></p>

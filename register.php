<?php
    require "includes/connect.php";

    $errors = [];
    $success = "";

    //form submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //grab form data
        $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
        $password = $_POST["password"] ?? "";
        $confirmPass = $_POST["confirmPass"] ?? "";
    
        //validate

        //username

        //blank
        if ($username == "") {
            $errors[] = "Please enter a username.";
        }

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
        //minimum length
        elseif(strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
        //blank confirm password
        elseif($confirmPass == "") {
            $errors[] = "Please confirm your password.";
        }
        //passwords don't match
        elseif($password != $confirmPass) {
            $errors[] = "Passwords don't match.";
        }

        //user already exists
        if(empty($errors)) {
            $sql = "SELECT id FROM usersF WHERE username = :username OR email = :email";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);

            $stmt->execute();

            //if the statement returns values, the email/username already exists
            if ($stmt->fetch()) {
                $errors[] = "Username or email already in use.";
            }
        }

        //add to database
        if(empty($errors)) {
            //hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usersF (username, email, password) VALUES (:username, :email, :hashedPassword)";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hashedPassword', $hashedPassword);

            $stmt->execute();

            $success = "Welcome, <em>" . $username . "</em>! You may now log in below.";
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

<h1>Register</h1>

<form id="registerForm" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email</label>
    <input type="text" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <label for="confirmPass">Confirm Password</label>
    <input type="password" id="confirmPass" name="confirmPass" required>

    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

<?php
    include "includes/footer.php";
?>

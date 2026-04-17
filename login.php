<?php
    require "includes/connect.php";

    $errors = [];
    $success = "";

    //form submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //grab form data
        $usernameOrEmail = trim($_POST["usernameOrEmail"] ?? "");
        $password = $_POST["password"] ?? "";
    
        //validate

        //username or email

        //blank
        if ($usernameOrEmail == "") {
            $errors[] = "Please enter a username or email.";
        }

        //password

        //blank
        if($password == "") {
            $errors[] = "Please enter a password.";
        }

        //try to login
        if(empty($errors)) {
            //find corresponding datablock based on username/email
            $sql = "SELECT id, username, email, password FROM usersF WHERE username = :usernameOrEmail OR email = :usernameOrEmail LIMIT 1";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":usernameOrEmail", $usernameOrEmail);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //check if the passwords match
            if($user && password_verify($password, $user['password'])) {
                //regenerate session id
                session_regenerate_id(true);

                //set session id and username
                $_SESSION["id"] = $user["id"];
                $_SESSION["username"] = $user["username"];

                //go to index
                header("Location: index.php");
                exit;
            } else {
                $errors[] = "Invalid password.";
            }
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
?>

<h1>Login</h1>

<form id="loginForm" method="post">
    <label for="usernameOrEmail">Username or Email</label>
    <input type="text" id="usernameOrEmail" name="usernameOrEmail" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>

<?php
    include "includes/footer.php";
?>

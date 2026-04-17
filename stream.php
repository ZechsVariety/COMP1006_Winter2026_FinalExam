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

    //retrieve all posts
    $sql = "SELECT * FROM postsF";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $posts = $stmt->fetchAll();

    if(count($posts) == 0) {
        echo("<p>Post something man</p>");
    }
    else {
        //show each post
        foreach($posts as $post) {
            echo("<h3>" . $post["title"] . "</h3>
                <img src='" . $post["imagePath"] . "' alt='2nd most awesome secret' height='100px'>");
        }
    }

    include "includes/footer.php";
?>

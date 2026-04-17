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
                <img src='" . $post["imagePath"] . "' alt='2nd most awesome secret' height='100px'>
                <a href='deleteImage.php?id=" . $post['id'] . "' role='button' onclick=\"return confirm('Are you sure you want to delete " . $post['title'] . "?');\">Delete</a>");
        }
    }

    include "includes/footer.php";
?>

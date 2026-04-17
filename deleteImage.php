<?php
    require "includes/connect.php";
    require "includes/authorize.php";

    //find id
    if(!isset($_GET["id"])) {
        echo("No image ID found.");
        include "includes/footer.php";
        die();
    }

    //parse id
    $postID = $_GET['id'];

    $sql = "DELETE FROM postsF WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $postID);

    $stmt->execute();

    //go back
    header("Location: stream.php");
?>

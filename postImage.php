<?php
    require "includes/connect.php";

    $errors = [];
    $success = "";

    //form submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //grab form data
        $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS));
        $password = $_POST["password"] ?? "";
    
        //validate

        //title

        //blank
        if($title == "") {
            $errors[] = "Please enter a title.";
        }

        //image

        $imagePath = null;

        //check if a file was uploaded
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] != UPLOAD_ERR_NO_FILE) {
            //check if there was an upload error
            if($_FILES["image"]["error"] != UPLOAD_ERR_OK) {
                $errors[] = "Image could not be uploaded.";
            }
            else {
                $allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp", "image/gif"];
                //actual type
                $detectedType = mime_content_type($_FILES["image"]["tmp_name"]);

                //check that it's the correct file type
                if(!in_array($detectedType, $allowedTypes, true)) {
                    $errors[] = "Incorrect file type. (allowed: jpeg, jpg, png, webp, gif)";
                }
                else {
                    //get file extension
                    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                    //create unique filename
                    $safeFilename = uniqid("image", true) . "AwesomeSecret." . strtolower($extension);

                    //build the full server path where the file will be stored
                    $destination = __DIR__ . "/uploads/" . $safeFilename;

                    //attempt to upload the file
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
                        //save the relative path to the database
                        $imagePath = "uploads/" . $safeFilename;

                        $success = "You image was uploaded! <a href='stream.php'>View Now</a>";
                    }
                    else {
                        $errors[] = "There was a problem moving your image to the database.";
                    }
                }
            }
        }
        else {
            $errors[] = "It don't work.";
        }

        //send to database

        $sql = "INSERT INTO postsF(title, imagePath) VALUES (:title, :imagePath)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':title',   $title);
        $stmt->bindParam(':imagePath', $imagePath);

        $stmt->execute();
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

<h1>Post an Image</h1>

<form id="imageForm" method="post" enctype="multipart/form-data">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" required>

    <label for="image">Image</label>
    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png, .webp, .gif" required>
    <p>PS: you can post gifs too.</p>

    <button type="submit">Post</button>
</form>

<?php
    include "includes/footer.php";
?>

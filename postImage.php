<?php
    require "includes/connect.php";

    $errors = [];
    $success = "";
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

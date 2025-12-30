<?php
include 'connects.php';
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data); // Removed typo here
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["csrf_token"]) &&
    $_POST["csrf_token"] === ($_SESSION["csrf_token"] ?? '')
) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check for upload error
    if ($_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
        echo "<script>alert('File upload error: " . $_FILES["fileToUpload"]["error"] . "'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Validate image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Check file size (limit 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Allowed file formats
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Try to upload
    if ($uploadOk && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        // Collect form data
        $cid = test_input($_POST['cid']);
        $vendor_id = test_input($_POST['vendor_id']);
        $cname = test_input($_POST['cname']);
        $cprice = test_input($_POST['cprice']);
        $category = test_input($_POST['category']);
        $cimage = $target_file;

        // Insert into database
        $mysqli = connectdb();
        $query = "INSERT INTO uploadchicken (cid, vendor_id, cname, cprice, category, cimage) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $mysqli->prepare($query);
        $statement->bind_param("ssssss", $cid, $vendor_id, $cname, $cprice, $category, $cimage);

        if ($statement->execute()) {
            echo '<script>alert("Chicken successfully uploaded!"); window.location="viewallchicken.php";</script>';
        } else {
            echo '<script>alert("Database error: ' . $mysqli->error . '"); window.history.back();</script>';
        }

        $statement->close();
        $mysqli->close();

    } else {
        echo '<script>alert("Failed to upload image. Check file type, size, and folder permissions."); window.history.back();</script>';
    }

} else {
    echo '<script>alert("Invalid request."); window.history.back();</script>';
}
?>

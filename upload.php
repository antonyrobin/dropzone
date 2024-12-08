<?php
$target_dir = "uploads/";

// Generate a unique filename
$unique_name = uniqid() . '_' . basename($_FILES["file"]["name"]);
$target_file = $target_dir . $unique_name;

// Check if file is an actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size (limit to 2MB)
if ($_FILES["file"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded as " . $unique_name;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

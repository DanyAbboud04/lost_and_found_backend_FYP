<?php

include 'connection.php';

$email = $_POST['email'];
$title = $_POST['title'];
$description = $_POST['description'];
$status = $_POST['status'];
$location = $_POST['location'];
$image = $_POST['image'];

$image_url = '';

if (!empty($image)) {
    $image_data = base64_decode($image);
    $file_name = uniqid() . '.png';
    $upload_dir = 'uploads/';
    $file_path = $upload_dir . $file_name;

    if (file_put_contents($file_path, $image_data)) {
        $image_url = $file_path;
    }
}

$query = "INSERT INTO posts (title, description, status, location, image, user_mail)
          VALUES ('$title', '$description', '$status', '$location', '$image_url', '$email')";



if (mysqli_query($con, $query)) {
    echo "success";
} else {
    echo "error";
}
?>
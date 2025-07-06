<?php
include 'connection.php';

$email = $_POST['email'];
$username = $_POST['username'];
$about = $_POST['about'];
$role = $_POST['role'];
$profile_pic = $_POST['profile_pic'];

$profile_pic_url = '';

if (!empty($profile_pic)) {
    $image_data = base64_decode($profile_pic);
    $file_name = uniqid() . '.png';
    $upload_dir = 'uploads/';
    $file_path = $upload_dir . $file_name;

    if (file_put_contents($file_path, $image_data)) {
        $profile_pic_url = $file_path;
    }
}

if (!empty($profile_pic_url)) {
    $query = "UPDATE users SET 
                username = '$username',
                about = '$about',
                role = '$role',
                profile_pic = '$profile_pic_url'
              WHERE email = '$email'";
} else {
    $query = "UPDATE users SET 
                username = '$username',
                about = '$about',
                role = '$role'
              WHERE email = '$email'";
}

if (mysqli_query($con, $query)) {
    echo "success";
} else {
    echo "error";
}
?>

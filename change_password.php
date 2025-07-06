<?php
include 'connection.php';

$email = $_POST['email'];
$new_password = $_POST['new_password'];
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";

if (mysqli_query($con, $query)) {
    echo "success";
} else {
    echo "error";
}
?>

<?php
include 'connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        $isAdmin = ($email === 'admin@gmail.com');
        echo json_encode([
            "status" => "success",
            "isAdmin" => $isAdmin
        ]);
    } else {
        echo json_encode(["status" => "wrong_password"]);
    }
} else {
    echo json_encode(["status" => "not_found"]);
}
?>

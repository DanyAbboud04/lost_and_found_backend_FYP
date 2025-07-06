<?php
    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($con , "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check)>0){
        echo 'exists';
        exit;
    }

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    if (mysqli_query($con, $query)) {
        echo "success";
    } else {
        echo "fail";
    }
?>
<?php
include 'connection.php';

$email = $_POST['email'];
$query = "SELECT username, about, role, profile_pic FROM users WHERE email='$email'";
$result = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($result)) {
    // $baseUrl = "http://192.168.0.101:8900/";  
    // $baseUrl = "http://192.168.1.150:8900/";
    $baseUrl = 'http://192.168.0.19:8900/'; 


    $fullImageUrl = !empty($row['profile_pic'])
        ? $baseUrl . $row['profile_pic']
        : '';

    echo json_encode([
        'status'      => 'success',
        'username'    => $row['username'],
        'about'       => $row['about'],
        'role'        => $row['role'],
        'profile_pic' => $fullImageUrl,
    ]);
} else {
    echo json_encode(['status' => 'not_found']);
}
?>

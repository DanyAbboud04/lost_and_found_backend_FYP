<?php
include 'connection.php';

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];

$query = "INSERT INTO chats (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>

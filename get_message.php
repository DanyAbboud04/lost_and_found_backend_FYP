<?php
include 'connection.php';

$sender = $_GET['sender'];
$receiver = $_GET['receiver'];

$query = "SELECT * FROM chats WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY date ASC";

$result = mysqli_query($con, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>

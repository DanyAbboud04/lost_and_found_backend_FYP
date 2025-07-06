<?php
include 'connection.php';

$user = $_GET['user'];

//here, we are taking 1 time, where the user is the sender or receiver, tajing the other user as receiver or sender
$query = "SELECT DISTINCT 
              CASE 
                  WHEN sender = '$user' THEN receiver 
                  ELSE sender 
              END AS chat_with 
          FROM chats 
          WHERE sender = '$user' OR receiver = '$user'";

$result = mysqli_query($con, $query);

$chatUsers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $chatUsers[] = $row['chat_with'];
}

echo json_encode(['status' => 'success', 'users' => $chatUsers]);
?>

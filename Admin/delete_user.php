<?php
include '../connection.php';

$email = $_POST['email'] ?? '';
$user_id = $_POST['user_id'] ?? '';

if (empty($email) || empty($user_id)) {
    echo json_encode(['result' => 'error', 'message' => 'Missing email or user ID']);
    exit;
}

mysqli_query($con, "DELETE FROM posts WHERE user_mail = '$email'");
$deleteChats = mysqli_query($con, "DELETE FROM chats WHERE sender = '$email' OR receiver = '$email'");
$user_id = (int)$user_id;
$deleteUser = mysqli_query($con, "DELETE FROM users WHERE id = $user_id AND email = '$email'");

if ($deleteUser) {
    if (mysqli_affected_rows($con) > 0) {
        echo json_encode(['result' => 'success']);
    } else {
        echo json_encode(['result' => 'not_found']);
    }
} else {
    echo json_encode(['result' => 'error']);
}
?>

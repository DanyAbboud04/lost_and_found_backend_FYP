<?php
include 'connection.php';

$email = $_POST['email'];
$post_id = $_POST['post_id'];

$query = "DELETE FROM posts WHERE id = '$post_id' AND user_mail = '$email'";

if (mysqli_query($con, $query)) {
    if (mysqli_affected_rows($con) > 0) {
        echo json_encode(['result' => 'success']);
    } else {
        echo json_encode(['result' => 'not_found']);
    }
} else {
    echo json_encode(['result' => 'error']);
}
?>

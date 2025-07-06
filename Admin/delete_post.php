<?php
include '../connection.php'; 

$post_id = $_POST['post_id'] ?? '';
$email = $_POST['email'] ?? '';  

if (empty($post_id)) {
    echo json_encode(['result' => 'error', 'message' => 'Missing post ID']);
    exit;
}

$query = "DELETE FROM posts WHERE id = '$post_id'";

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

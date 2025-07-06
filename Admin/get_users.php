<?php
include '../connection.php';

// count users
$query = "  
SELECT u.id, u.email, u.username, u.about, u.role, COUNT(p.id) AS post_count
FROM users u
LEFT JOIN posts p ON u.email = p.user_mail
WHERE u.email != 'admin@gmail.com'
GROUP BY u.id, u.email, u.username, u.about, u.role
";

$result = mysqli_query($con, $query);

$users = [];  
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = [
        'id' => $row['id'],
        'email' => $row['email'],
        'username' => $row['username'],
        'about' => $row['about'],
        'role' => $row['role'],
        'post_count' => $row['post_count'],
    ];
}

if (count($users) > 0) {
    echo json_encode(['result' => 'success', 'users' => $users]);
} else {
    echo json_encode(['result' => 'not_found']);
}
?>

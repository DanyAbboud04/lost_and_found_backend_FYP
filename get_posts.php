<?php
include 'connection.php';

$status = $_GET['status'] ?? '';  //status 
$search = $_GET['search'] ?? '';  //search value
$sort = $_GET['sort'] ?? 'desc';  //oldest or newest first
$email = $_GET['email'] ?? '';  //for my posts

$query = "SELECT id, title, description, status, location, date, image, user_mail FROM posts WHERE 1=1";  //query where we can add to it other queries

if (!empty($status)) {
    $query .= " AND status = '" . mysqli_real_escape_string($con, $status) . "'";  //concatenate status value
}

if (!empty($search)) {
    $safeSearch = mysqli_real_escape_string($con, $search);  //prevent sql injections
    $query .= " AND (title LIKE '%$safeSearch%' OR description LIKE '%$safeSearch%' OR location LIKE '%$safeSearch%')";  //concatenate search value
}

if (!empty($email)) {  //for my posts
    $query .= " AND user_mail = '" . mysqli_real_escape_string($con, $email) . "'";
}

if ($sort == 'asc') {  //concatenate order
    $query .= " ORDER BY date ASC";
} else {
    $query .= " ORDER BY date DESC";
}

$result = mysqli_query($con, $query);  //execute the query, store result in $result

$baseUrl = 'http://192.168.0.19:8900/'; 
// $baseUrl = "http://192.168.0.101:8900/";  

$posts = [];  //get the posts
while ($row = mysqli_fetch_assoc($result)) {
    $fullImageUrl = !empty($row['image']) ? $baseUrl . $row['image'] : '';

    $posts[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'status' => $row['status'],
        'location' => $row['location'],
        'date' => $row['date'],
        'image' => $fullImageUrl,
        'user_mail' => $row['user_mail'],
    ];
}

if (count($posts) > 0) {
    echo json_encode(['result' => 'success', 'posts' => $posts]);
} else {
    echo json_encode(['result' => 'not_found']);
}
?>

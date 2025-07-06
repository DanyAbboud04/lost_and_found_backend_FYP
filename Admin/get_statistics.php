<?php
include '../connection.php';

// total posts
$totalPosts = mysqli_fetch_assoc(
    mysqli_query($con, "SELECT COUNT(*) AS total FROM posts")
)['total'] ?? 0;

// posts by status
$statusCounts = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT 
        SUM(status = 'Lost') AS lost,
        SUM(status = 'Found') AS found
    FROM posts
"));

// posts per day (last 7 days)
$dailyPosts = [];
$dateResult = mysqli_query($con, "
    SELECT DATE(date) AS date, COUNT(*) AS count
    FROM posts
    WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY DATE(date)
    ORDER BY DATE(date)
");
while ($row = mysqli_fetch_assoc($dateResult)) {
    $dailyPosts[] = $row;
}

echo json_encode([
    'result' => 'success',
    'data' => [
        'total_posts' => $totalPosts,
        'status_counts' => $statusCounts,
        'posts_per_day' => $dailyPosts
    ]
]);
?>

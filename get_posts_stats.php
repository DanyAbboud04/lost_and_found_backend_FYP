<?php
include 'connection.php';

$email = $_POST['email'];

$query = "SELECT status FROM posts WHERE user_mail = '$email'";
$result = mysqli_query($con, $query);

$total = 0;
$lost = 0;
$found = 0;

while ($row = mysqli_fetch_assoc(result: $result)) {
    $total++;
    if ($row['status'] == 'Lost') $lost++;
    if ($row['status'] == 'Found') $found++;
}

echo json_encode([
    'status' => 'success',
    'total' => $total,
    'lost' => $lost,
    'found' => $found
]);

?>

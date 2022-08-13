<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT
test.posts.title,
test.posts.slug,
test.posts.body,
test.users.`name`,
test.users.email,
test.posts.published_at
FROM
test.posts
INNER JOIN test.users ON test.posts.author_id = test.users.id";
$result = mysqli_query($conn, $sql);
$data = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
echo json_encode(array('data'=>$data));

mysqli_close($conn);

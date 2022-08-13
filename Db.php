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

$rows_per_page = 10;
$page_no = $_GET['p'] ?? 1;
$start = ($page_no - 1) * $rows_per_page;

$sql = "SELECT
test.posts.id,
test.posts.title,
test.posts.slug,
test.posts.body,
test.users.`name`,
test.users.email,
test.posts.published_at
FROM
test.posts
INNER JOIN test.users ON test.posts.author_id = test.users.id order by test.posts.id
limit {$start},{$rows_per_page}";

$result = mysqli_query($conn, $sql);

$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT
test.posts.id
FROM
test.posts
INNER JOIN test.users ON test.posts.author_id = test.users.id"));

$data = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
$last_page_no = ceil($total_rows / $rows_per_page);
echo json_encode(array('data'=>$data,'p'=>$page_no,'last_page'=>$last_page_no));

mysqli_close($conn);

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
INNER JOIN test.users ON test.posts.author_id = test.users.id
limit {$start},{$rows_per_page}";

$result = mysqli_query($conn, $sql);

$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT
test.posts.id
FROM
test.posts
INNER JOIN test.users ON test.posts.author_id = test.users.id"));

while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['id']} ===> {$row['name']} --> {$row['slug']} <br>";
}
$first = "<a href='pagination.php?p=1'>First</a>";
$last_page_no = ceil($total_rows / $rows_per_page);
$last = "<a href='pagination.php?p={$last_page_no}'>Last</a>";

if ($page_no >= $last_page_no) {
    $next = "<a>Next</a>";
} else {
    $next_page_no = $page_no + 1;
    $next = "<a href='pagination.php?p={$next_page_no}'>Next</a>";
}

if ($page_no <= 1) {
    $prev = "<a>Previous</a>";
} else {
    $prev_page_no = $page_no - 1;
    $prev = "<a href='pagination.php?p={$prev_page_no}'>Previous</a>";
}

$last = "<a href='pagination.php?p={$last_page_no}'>Last</a>";

echo "$first | $prev | Page $page_no of $last_page_no $next | $last";












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
test.posts.id,
test.posts.title,
test.posts.slug,
test.posts.body,
test.users.`name`,
test.users.email,
test.posts.published_at
FROM
test.posts
INNER JOIN test.users ON test.posts.author_id = test.users.id order by test.posts.id ";

$result = mysqli_query($conn, $sql);



?>
<?php
header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=download.xls');
?>
<table border="1">
    <tr>
        <th>id</th>
        <th>title</th>
        <th>slug</th>
        <th>body</th>
        <th>name</th>
        <th>email</th>
        <th>published_at</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($result)) {
        $output = "<tr>";
        $output .= "<td>{$row['id']}</td>";
        $output .= "<td>{$row['title']}</td>";
        $output .= "<td>{$row['slug']}</td>";
        $output .= "<td>{$row['body']}</td>";
        $output .= "<td>{$row['name']}</td>";
        $output .= "<td>{$row['email']}</td>";
        $output .= "<td>{$row['published_at']}</td>";
        $output .= "</tr>";
        echo $output;
    }
    ?>
</table>






<?php
require "includes/connect.php";

if (isset($_POST['username'], $_POST['post_id'], $_POST['comment'])) {
    $username = $_POST['username'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (username, post_id, comments) VALUES (:username, :post_id, :comment)");
    $insert = $stmt->execute([
        ':username' => $username,
        ':post_id' => $post_id,
        ':comment' => $comment
    ]);

    echo $insert ? "Comment added successfully" : "Failed to add comment";
} else {
    echo "Incomplete form data";
}
?>

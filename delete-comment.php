<?php
require "includes/connect.php";

if (isset($_POST['delete']) && $_POST['delete'] === 'delete') {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = :id");
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount()) {
        echo "Comment deleted successfully";
    } else {
        echo "Failed to delete comment";
    }
}
?>

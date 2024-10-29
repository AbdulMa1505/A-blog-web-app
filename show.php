<?php 
require "includes/header.php";
require "includes/connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM post WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $posts = $stmt->fetch(PDO::FETCH_OBJ);
}
    $comments = $conn->prepare("SELECT * FROM comments WHERE post_id = :id");
    $comments->execute([':id' => $id]);
    $comment = $comments->fetchAll(PDO::FETCH_ASSOC)
?>

<div class="row">
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($posts->title); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($posts->body); ?></p>
            <a href="index.php" class="btn btn-success btn-sm">back</a>
        </div>
    </div>
</div>

<div class="row">
    <form method="POST" id="comment_data">
        <input name="username" type="hidden" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
        <input name="post_id" type="hidden" value="<?php echo $posts->id; ?>">

        <div class="form-floating mt-3">
            <textarea name="comment" rows="4" class="form-control"></textarea>
            <label for="comment">Comment</label>
        </div>
        <br>
        <div class="d-grid col-6 g-2 mx-auto">
            <button id="submit" class="w-100 btn btn-lg btn-primary" type="submit">Comment</button>
        </div>
    </form>
    <div id="msg" class="mt-3"></div>
</div>
<div id="comment-section" class="row">
    <?php foreach($comment as $singleComment): ?>
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($singleComment['username']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($singleComment['comments']); ?></p>
            <button class="delete-btn btn btn-lg btn-danger btn-sm" value="<?php echo $singleComment['id']; ?>" type="button">Delete</button>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require "includes/footer.php"; ?>

<script>
$(document).ready(function() {
    $('#comment_data').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'insert-comments.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#msg').html(response).addClass("alert alert-success bg-success text-white mt-3");
                $('#comment_data')[0].reset();
            },
            error: function() {
                $('#msg').html("Failed to submit comment").addClass("alert alert-danger");
            }
        });
    });
});
$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    var id = $(this).val();

    $.ajax({
        type: 'POST',
        url: 'delete-comment.php',
        data: { delete: 'delete', id: id },
        success: function(response) {
            alert("Comment deleted successfully.");
            fetch();  // Re-fetch the comments after deletion
        },
        error: function() {
            $('#msg').html("Failed to delete comment").addClass("alert alert-danger");
        }
    });
});


    function fetch(){
    setInterval(() => {
        $("body").load("show.php?id=<?php echo  $_GET['id']; ?>")
    }, 4000);
}
</script>

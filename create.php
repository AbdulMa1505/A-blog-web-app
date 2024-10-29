<?php require "includes/header.php"; 
require "includes/connect.php";
if(isset($_SESSION['username'])){
    
}
if(isset($_POST['post'])){
    if(empty('title') || empty('body') ){
      echo "<script> alert('all entries must be filled') </script>";
  
    }
  
    else{
      $title =$_POST['title'];
      $body =$_POST['body'];
      $username =$_SESSION['username'];
      $stmt =$conn->prepare("INSERT INTO post(title,body,username) VALUES(:title,:body,:username)");
  
      $insert=$stmt->execute([
        ':title'=>$title,
        ':body'=>$body,
        ':username'=>$username,
      ]);
      header('Location:index.php');
      exit();
      
    }
  }



?>
<main class="form-signin w-50 m-auto">
  <form method="POST" action="create.php">
    <h1 class="h3 mt-5 fw-normal text-center">Create Post</h1>
    <div class="form-floating">
        <input name="title" type="text" class="form-control" id="floatingInput" placeholder="Title.....">
        <label for="floatingInput">Title</label>
    </div>

<br>
    <div class="form-floating">
        <textarea name="body" class="form-control" rows="5" placeholder="body"></textarea>
        <label for="">body</label>
    </div>
<br>

    <div class="d-grid col-6 g-2 mx-auto">
    <button name="post" class="w-100 btn btn-lg btn-primary" type="submit">post</button>
    </div>
  </form>
</main>

<?php require "includes/footer.php"; ?>
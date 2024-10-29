<?php require "includes/header.php"; 
require "includes/connect.php";
if(isset($_POST['login'])){
  if(empty('email') || empty('username') || empty('password')){
    echo "<script> alert('all entries must be filled') </script>";

  }

  else{
    $email =$_POST['email'];
    $password =$_POST['password'];
    $stmt =$conn->query("SELECT * FROM entry  WHERE email ='$email' ");

  $stmt->execute();
  $data=$stmt->fetch(PDO::FETCH_ASSOC);
  if($stmt->rowCount()>0){
    if(password_verify($password,$data['password'])){
      echo "logged in";
      $_SESSION['username']=$data['username'];
      header('Location:index.php');
    }
    else{
       echo "invalid email or password";
    }
  }
  else{
    echo "invalid email or password";
  }
    
    
  }
}
?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="login" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>

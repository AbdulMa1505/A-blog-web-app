<?php 
require "includes/header.php"; 
require "includes/connect.php"; 

$stmt =$conn->query("SELECT * FROM post");
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
?>
<main class="form-signin w-50 m-auto m-5">
<?php foreach ($rows as $row):?>
    <div class="card">
   
    <div class="card-body mb-4">
        <h5 class="card-title"><?php echo $row->title;?></h5>
        <p class="card-text"><?php echo substr($row->body,0,85)."...";?></p>
        <a href="show.php?id=<?php echo $row->id;?>" class="btn btn-primary">read more</a>
    </div>
    </div>
    <br><br>
<?php endforeach ;?>
</main>
<?php require "includes/footer.php"; ?>

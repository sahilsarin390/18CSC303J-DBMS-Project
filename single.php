<?php

require "includes/init.php";

require "includes/head.php";

$db = new Database();
$conn = $db->getConn();



if(isset($_GET['id']) && is_numeric($_GET['id'])) {

$article = Article::getByCategory($conn,$_GET["id"]);

}

 ?>

    <?php if (empty($article)): ?>
      <p>Nothing found.</p>
    <?php else: ?>

  <div class="container">
      <div class="alert alert-info" style="margin-top: 10px;"> 
      <?= htmlspecialchars($article[0]['title']); ?> 
      </div>
      
      <div class="card-body" style="padding-top: 5px !important;">
      <?= str_replace(array("\n"),array("<br>"),htmlspecialchars($article[0]['post'])); ?>
      </div>

     
      <?php if($article[0]['category']): ?>
      <div class="card-body" style="padding-top: 5px !important;">  Category -
      <?php foreach($article as $a): ?>
      <?= str_replace(array("\n"),array("<br>"),htmlspecialchars($a['category'])); ?>,
      <?php endforeach; ?>
      </div>
      <?php endif; ?>
      

      <?php if (!empty($article[0]['image_file'])): ?>
      <div class="card-body" style="padding-top: 5px !important;">
      <img src= "/uploads/<?=$article[0]['image_file'];?>" style="max-width:400px;" /> 
      </div>
      <?php endif; ?>
      
  </div>
  </div>

  <?php if (isset($_SESSION['login']) && $_SESSION['login']): ?>

    <div class="container">
      <a class="btn btn-outline-dark" href = "edit.php?id=<?= $article[0]['id'] ?>">Edit Post</a>
      <a class="btn btn-outline-dark" href = "delete.php?id=<?= $_GET["id"] ?>">Delete Post</a>
      <a class="btn btn-outline-dark" href = "edit-image.php?id=<?= $article[0]['id'] ?>">Edit Image</a>
      <a class="btn btn-outline-dark" href = "delete-image.php?id=<?= $article[0]['id'] ?>">Delete Image</a>
    </div>
  <?php endif; ?>
<?php endif; ?>


<?php require "includes/foot.php" ?>

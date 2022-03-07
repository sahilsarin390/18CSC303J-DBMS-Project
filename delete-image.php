
<?php 

require "includes/init.php";

require "includes/head.php";


$db = new Database();
$conn = $db->getConn();

Auth::requireLogin();

$article = Article::getArticle($conn,$_GET["id"]);



if(isset($_GET["id"])) {

   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
   $previous_image = $article->image_file;

   //update the image
    if($article->setImageFile($conn,NULL)) { 

        if ($previous_image) { // exist
            unlink( getcwd() . "/uploads/$article->image_file");
            }

            echo '<div class="container"><div class = "alert alert-success">File Uploaded Sucessfully</div></div>';
            redirect("single.php?id=" . $article->id); 
        }

    }
}
    

 ?>

<div class = "container">
        <h1>Delete Article Image </h1>

        <form method="post">

        <div class="form-group">
        <label>Are You Sure ? </label>
        <br>
        <button class="btn btn-outline-dark">Delete</button>


    </form>
        <?php if (!empty($article->image_file)): ?>
      <div class="card-body" style="padding-top: 5px !important;">
      <img src= "/uploads/<?=$article->image_file;?>" style="max-width:400px;" /> 
      </div>
      <?php endif; ?>


        </div>
<?php require "includes/foot.php" ?>

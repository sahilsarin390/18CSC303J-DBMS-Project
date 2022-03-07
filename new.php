
<?php 


require "includes/init.php";

include "includes/head.php";


$db = new Database();
$conn = $db->getConn();

$article = new Article();

Auth::requireLogin();

?>


<div class="container" style="width: 60%;">

   
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $article->title = $_POST['title'];
    $article->post = $_POST['post'];

    $errors = $article->validateArticle();


if ($errors == true) { //True means errors are empty

    if($article->newArticle($conn)) {

            redirect("single.php?id=" . $article->id); 
            echo '<div class="alert alert-success"> Post Submitted Sucessfully with Id ' . $article->id . ' </div>';
        
        }
    }

}

?>
<div class="alert alert-info" style="margin-top: 6px;"> Post New Article </div>

<?php
require 'includes/article-form.php'; 

include 'includes/foot.php';

?>

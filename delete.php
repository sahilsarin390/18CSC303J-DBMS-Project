
<?php 

require "includes/init.php";

require "includes/head.php";


$db = new Database();
$conn = $db->getConn();

Auth::requireLogin();

    if (isset($_GET['id'])) {

        $article = Article::getArticle($conn,$_GET["id"]);


        if (! $article) {
            die ('article not found');
        }
    

    }
    else {
        die ('id not supplied');
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if($article->deleteArticle($conn)) {
                echo '<div class="alert alert-success">Article with ID : '. $article->id . ' is successfully deleted</div>';
            redirect("");
            }

    }


?>

<div class="container">

    <form method="post">
        <h1>Delete Article</h1>
        <div class="form-group">
        <label>Are You Sure ? </label>
        <br>
        <button class="btn btn-outline-dark">Delete</button>


    </form>
    <a class="btn btn-outline-dark" href="single.php?id=<?= $_GET['id'] ?>">Cancel</a>
    </div>

</div>

<?php require 'includes/foot.php'; ?>

<?php 


require "includes/init.php";

require "includes/head.php";


$db = new Database();
$conn = $db->getConn();

Auth::requireLogin();

$article = Article::getArticle($conn,$_GET["id"]);



$categories = Category::getAll($conn);

$category_id = array_column($article->getByCategory($conn, $_GET["id"]), 'category_id');
echo '<hr>';



if(isset($_GET["id"])) {

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $category_id = $_POST['category'] ?? [];
        var_dump($category_id);
        exit;

        $article->id = $_GET['id'];
        $article->title = $_POST['title'];
        $article->post = $_POST['post'];

   

        $errors = $article->validateArticle();
   

    if ($errors == true) { //True means errors are empty

        if($article->updateArticle($conn)) {

                echo '<div class="alert alert-success">Article Editied Sucessfully Redirecting in 1 Second</div>';
                redirect("single.php?id=" . $article->id); 
            
        }
    }
}
   
}
 ?>

    <?php if (empty($article)): ?>
      <p>Article Not Found</p>
    <?php else: ?>
        <h1>Edit Article </h1>

        <?php include 'includes/article-form.php'; ?>

    

<?php endif; ?>


<?php require "includes/foot.php" ?>

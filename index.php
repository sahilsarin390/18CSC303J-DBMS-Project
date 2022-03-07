<?php

require "includes/init.php";

require "includes/head.php";

$db = new Database();
$conn = $db->getConn();


//?? = isset
$limit_per_page = 5;
$pages = new Pages($conn, $limit_per_page, $_GET['page'] ?? 1);

$articles = Article::getPage($conn, $pages->limit,$pages->offset);

 

?>



    <?php if (empty($articles)): ?>
      <p>Nothing found.</p>
    <?php
else: ?>

  <?php foreach ($articles as $article): ?>

    <a href="single.php?id=<?=htmlspecialchars($article['id']); ?>" class="list-group-item list-group-item-action">
 
        <?=$article['title'] ?> 

     <p> <?= htmlspecialchars($article['post']) . ' ...'; ?></p> </a>
     

 <?php endforeach; ?>

<?php endif; ?>

<nav class='pagination justify-content-center'>
    <?php if ($pages->previous == 0): ?>
      <div class="page-item disabled"> <a class="page-link">Previous</a></div>
    <?php else: ?>
      <a class="page-link" href="?page=<?= $pages->previous; ?>">Previous</a>
    <?php endif; ?>

    <?php 

    for($i=$pages->previous+1; $i<= $pages->next+1; $i++) {
        echo '<a class="page-link" href="?page=' . $i . ' ">' . $i . '</a>';
        if ($i >= $pages->total) {
          break;
        }
    }
    ?>

    <?php  if ($pages->next <= $pages->total) : ?>
          <a class="page-link" href="?page=<?= $pages->next; ?>">Next </a>
    <?php else: ?>
          <div class="page-item disabled"> <a class="page-link">Next</a></div>
    <?php endif?>

</nav>

<?php require "includes/foot.php" ?>

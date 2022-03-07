
<?php
   $id = '';
   if (isset($_GET['id'])) {
    $id = ' - ' . $_GET['id'];
   }
?>
<footer>


  <div class="breadcrumb">
   <a href="/" class="breadcrumb-item">Home</a>
  
   <?php 
   

    //will show current page url without .php
   $name = str_ireplace(array('.php', 'single', 'new'), array('', 'article', 'post new article'), basename($_SERVER['PHP_SELF']) ) ?>
    <div class="breadcrumb-item active" aria-current="page"><?=ucwords($name) . $id; ?></div>
    
</div>



  <div class="nav justify-content-center" style="background-color: #000; height: 40px;">


  
    <div style="text-align: center; color:#fff; margin: auto"> 2021 Copyright © ShivBlog</div>
    </footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>

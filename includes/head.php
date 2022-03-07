<?php 
  function redirect($url) {
    header("refresh:1; url=http://" . $_SERVER['HTTP_HOST'] ."/$url"); 
  }

  ?>



<html>
  <heat><title>MY BLOG</title></head>
  
  <link href="includes/bootstrap.css" rel="stylesheet">

  <style>
        body {
          padding-bottom: 100px;
        }
        footer {
          position: fixed;
          bottom: 0;
          width: 100%;
        }
        .btn {
          margin: 2px;
        }
        .list-group-item {
          background-color: #f2f2f2;
        }
        .breadcrumb {
        margin: 0px !important;
        }
    </style>

<body style="background-color:  #f2f2f2;">

<nav class="navbar navbar-dark navbar-expand-lg bg-dark">

<a class="navbar-brand" href="/">ShivBlog</a>

    <div class="navbar-nav mr-auto">
     <!-- <li class="nav-item active">
        <a class="nav-link" href=""> </a>
      </li> -->
      </div>

    <span class="navbar-text">
      <?php if (Auth::isLogin()): ?>
        <a href = "/new.php" style="color: #e6e6e6; margin-right:10px;">Post New Article</a>
        <a href = "/logout.php" style="color: e6e6e6;">Logout</a>
     <?php else: ?>
      <a href = "/login.php" style="color:  #e6e6e6;">Login Here</a>
      <?php endif; ?>
    </span>

  </nav>
 

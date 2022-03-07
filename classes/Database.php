<?php

class Database {
  
  //Get Connection to Server

function getConn() {

$host = "localhost";
$db = "article";
$user = "goi";
$pass = "password";

$dsn = 'mysql:host=' .$host . ';dbname=' . $db . ';charset=utf8';

try {
  $db = new PDO($dsn, $user, $pass);

  //it will show the error message
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }

}

}

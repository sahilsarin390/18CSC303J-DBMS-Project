<?php 

class User {
     
    public $id;
    public $username;
    public $password;

    public static function auth($conn,$username,$password) {
    
    $sql = 'SELECT * FROM user WHERE username = :username';

    $stmt = $conn->prepare($sql);
    
    $stmt->bindValue(':username',$username, PDO::PARAM_STR);

      //return object instead of array 
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    
    $stmt->execute();
    if($user = $stmt->fetch()) {
      
      //Will verify has and password
     return password_verify($password, $user->password);
      // use password_hash($password); to generate hash
    }

    }
}
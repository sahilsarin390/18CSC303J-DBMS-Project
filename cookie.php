<?php 


?>

<?php 

require "includes/init.php";

require 'includes/head.php';


$db = new Database();
$conn = $db->getConn();
 
    if (Auth::getAuth()) {
   
        die('<div class="alert alert-warning">You are already Logged in Redirecting in 1 Second</div>');
   
    }

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (User::auth($conn,$_POST['username'],$_POST['password'])) {
        
     
        $name = "username";
		$value = htmlspecialchars($_POST["username"]);
		
		setCookie($name, $value, time() + (86400 * 1), "/");
		$login = $_COOKIE["username"];
		echo 'Hello ';
		echo $login ?? 'guest';

        }
        else {
        $error = 'Incorrect Login Details';
        } 
    
}

?>

<div class="container" >
    <?php if(isset($error)): ?>
<div class="alert alert-warning"><?=$error ?></div>
        <?php endif; ?>
<h1>Login </h1>
<form method = "post">
<div class="form-group">
<label>Username</label>
<input name = "username" class="form-control">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name ="password" class="form-control">
</div>
<button class = "btn btn-outline-dark">Submit</button>
</form>
</div>

<?php require "includes/foot.php" ?>

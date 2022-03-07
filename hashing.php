
<?php 

//Enter Your Password Here without spacing
$yourPassword = 'YourPassword';

$hash = password_hash($yourPassword, PASSWORD_DEFAULT);

echo $hash;

// open http://yourwebsite.com/hashing.php after entering your password here and copy the hash and paste in your sql user file
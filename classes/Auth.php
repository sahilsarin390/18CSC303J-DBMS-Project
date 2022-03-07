
<?php

class Auth {

    public static function getAuth() {
        return isset($_SESSION['login']) && $_SESSION['login'];

    }

    //will give error when user is not logged in 
    public static function requireLogin() {

        if (! Auth::getAuth()) {
        die ('You are not Authorized');
        }
    }   

    public static function isLogin() {
        return isset($_SESSION['login']) && $_SESSION['login'];
    }

}
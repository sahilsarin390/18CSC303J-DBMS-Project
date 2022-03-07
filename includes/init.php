<?php

//Auto Load Classes Function

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});

session_start();
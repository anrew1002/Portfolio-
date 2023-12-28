<?php

include 'init.php';


// use App\View;
use App\IndexController;
use App\Auth;
use App\View;

$View = new View;
// $Controller = new IndexController();
$Auth = Auth::getInstance();


switch (getenv('REQUEST_METHOD')) {

    case "GET":

        $View->render('login_template');
        break;
    case "POST":
        // print_r($_POST['username']);
        $Auth->authorize($_POST['username'], $_POST['password']);
        header("Location: index.php");
        break;
}

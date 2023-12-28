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
        $Auth->close_session();
        header("Location: login.php");
        break;
}

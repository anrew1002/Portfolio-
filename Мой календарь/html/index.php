<?php

include 'init.php';


// use App\View;
use App\IndexController;
use App\Auth;

// $View = new View;
$Controller = new IndexController();
$Auth = Auth::getInstance();

if ($Auth->is_authed()) {
    switch (getenv('REQUEST_METHOD')) {

        case "GET":
            // phpinfo();
            $Controller->show();
            break;
        case "POST":
            $Controller->store();
            // header('Refresh:0');
            break;
    }
} else {
    header("Location: login.php");
}

<?php

include 'init.php';


use App\View;
use App\TaskEditController;
use App\Auth;

$View = new View;
$Controller = new TaskEditController();
$Auth = Auth::getInstance();

if ($Auth->is_authed()) {

    switch (getenv('REQUEST_METHOD')) {

        case "GET":
            // phpinfo();
            $Controller->show();
            break;
        case "POST":
            print_r($_POST);
            if (isset($_POST['delete'])) {
                $Controller->delete();
            } else {
                $Controller->store();
            }
            header("Location: index.php");
            break;
    }
} else {
    header("Location: login.php");
}

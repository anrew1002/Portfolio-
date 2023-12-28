<?php

include 'init.php';


// use App\View;
use App\IndexController;
use App\Auth;
use App\View;
use App\Database\UserTable;

$View = new View;
// $Controller = new IndexController();
$Database = UserTable::getInstance();
$Auth = Auth::getInstance();


switch (getenv('REQUEST_METHOD')) {

    case "GET":
        $View->render('signup_template');
        break;
    case "POST":
        // print_r($_POST['username']);
        if (strlen($_POST['username']) > 8 || strlen($_POST['password']) > 8) {
            if (empty($Database->getUser($_POST['username']))) {
                $Database->insertUser(['username' => $_POST['username'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);
                $Auth->authorize($_POST['username'], $_POST['password']);
                header("Location: index.php");
            } else {
                flash('Логин уже занят');
                header("Location: signup.php");
            }
        } else {
            flash('Данные должны быть длиннее 8 символов');
            header("Location: signup.php");
        }
        break;
}

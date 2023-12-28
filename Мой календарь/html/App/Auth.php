<?php

namespace App;

use App\Request;
use App\Database\UserTable;

class Auth
{
    protected $authed = false;
    protected $database;
    protected $request;
    protected static $instance;
    protected $username;

    function __construct()
    {
        $this->request = new Request;
        $this->database = UserTable::getInstance();
        $this->authed = $_SESSION['is_authed'] ?? null;
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function authorize($username, $password)
    {
        $user = $this->database->getUser($username);
        print_r($user);
        if (!empty($user)) {
            if (password_verify($password, $user['password_hash'])) {
                $this->authed = true;
                $_SESSION['is_authed'] = true;
                $_SESSION['user_id'] = $user['id'];
            } else {
                flash("Введенные данные не верны");
            }
        };
    }
    // public function rememberMe()
    // {
    //     $password = $_COOKIE['JTKSToken'] ?? null;
    //     if (!empty($password)) {
    //         if ($password === 'd033e22ae348aeb5660fc2140aec35850c4da997') {
    //             $this->authed = true;
    //         }
    //     }
    // }
    public function is_authed()
    {
        return $this->authed;
    }
    public function getUsername()
    {
        return $this->authed;
    }
    public function close_session()
    {
        // setcookie('password', '', -100);
        setcookie(session_name(), '', -100);
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}

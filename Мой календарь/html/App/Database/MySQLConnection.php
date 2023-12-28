<?php

namespace App\Database;

use PDO;

class MySQLConnection
{
    private $pdo;
    private static $instance = null;

    private function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'tasklist_db';
        $user = 'tasklist';
        $pass = 'password';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            =>  PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}

MySQLConnection::getInstance();

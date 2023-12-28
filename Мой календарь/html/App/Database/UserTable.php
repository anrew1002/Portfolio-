<?php

namespace App\Database;

use App\Database\MySQLConnection;

class UserTable
{
    private static $instance = null;
    private $Connector;

    private function __construct()
    {
        $this->Connector = MySQLConnection::getInstance();
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function getUser($username = null): array
    {

        $query = " SELECT * FROM `user` WHERE username = ? LIMIT 1;";

        $stmt = $this->Connector->getConnection()->prepare($query);
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
        print_r($result);
        if (count($result) === 0) {
            return [];
        }
        return $result[0];
    }
    public function insertUser(array $userData)
    {

        $query = "INSERT INTO `user` (username,password_hash) VALUES (?,?)";
        $stmt = $this->Connector->getConnection()->prepare($query);
        $stmt->execute([strip_tags($userData['username']), $userData['password']]);
    }
}

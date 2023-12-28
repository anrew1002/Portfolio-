<?php

namespace App\Database;

use App\Database\MySQLConnection;

class TaskTable
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
    public function getTasks($id = null): array
    {
        if (!empty($id)) {
            $query = "SELECT tsk.id,tsk.name,t.name as type,tsk.place,DATE_FORMAT(tsk.date,'%d.%m.%Y %H:%i') as date,tsk.duration,comment,done FROM tasks as tsk JOIN types as t ON t.id = tsk.type_id WHERE tsk.id=? and user_id =?;";
            $stmt = $this->Connector->getConnection()->prepare($query);
            $stmt->execute([$id, $_SESSION['user_id']]);
            $result = $stmt;
        } else {
            $query = "SELECT tsk.id,tsk.name,t.name as type,tsk.place,DATE_FORMAT(tsk.date,'%d.%m.%Y %H:%i') as date,tsk.duration,comment,done FROM tasks as tsk JOIN types as t ON t.id = tsk.type_id WHERE user_id =" . $_SESSION['user_id'] . " ORDER BY done,tsk.date";
            $result = $this->Connector->getConnection()->query($query);
        }
        // print_r($result);
        return $result->FetchAll();
    }
    public function insertTask(array $discription)
    {

        $query = "INSERT INTO tasks (type_id,name,place,`date`,duration,`comment`,done,user_id) VALUES (:type,:name,:place, :date, :duration, :comment,:done,:user_id);";
        $stmt = $this->Connector->getConnection()->prepare($query);
        $stmt->execute([
            "name" => strip_tags($discription['name']),
            "type" => strip_tags($discription['type']),
            "place" => strip_tags($discription['place']),
            "date" => strip_tags($discription['date'] . " " . $discription['time']),
            "duration" => strip_tags($discription['duration']),
            "comment" => strip_tags($discription['comment']),
            "done" => strip_tags($discription['done']),
            "user_id" => $_SESSION['user_id'],
        ]);
    }
    public function getTaskByDate($date)
    {
        if (!empty($date)) {
            $query = "SELECT tsk.id,tsk.name,t.name as type,tsk.place,DATE_FORMAT(tsk.date,'%d.%m.%Y %H:%i') as date,tsk.duration,comment,done FROM tasks as tsk JOIN types as t ON t.id = tsk.type_id WHERE DATE(tsk.date) BETWEEN ? and ?;";
            $stmt = $this->Connector->getConnection()->prepare($query);
            if (is_array($date)) {
                $stmt->execute($date);
            } else {
                $stmt->execute([$date, $date]);
            }
            $result = $stmt;
            return $result->FetchAll();
        } else {
            $query = "SELECT tsk.id,tsk.name,t.name as type,tsk.place,DATE_FORMAT(tsk.date,'%d.%m.%Y %H:%i') as date,tsk.duration,comment,done FROM tasks as tsk JOIN types as t ON t.id = tsk.type_id ORDER BY done,tsk.date";
            $result = $this->Connector->getConnection()->query($query);
            return $result->FetchAll();
        }
    }
    public function updateTask(array $discription, int $id)
    {

        $query = " UPDATE tasks SET type_id = :type,name=:name,place=:place,`date`=:date,duration=:duration,`comment`=:comment,done=:done WHERE id=:id;";
        $stmt = $this->Connector->getConnection()->prepare($query);
        $stmt->execute([
            "name" => strip_tags($discription['name']),
            "type" => strip_tags($discription['type']),
            "place" => strip_tags($discription['place']),
            "date" => strip_tags($discription['date'] . " " . $discription['time']),
            "duration" => strip_tags($discription['duration']),
            "comment" => strip_tags($discription['comment']),
            "done" => strip_tags($discription['done']),
            "id" => strip_tags($id),
        ]);
    }
    public function deleteTask(int $id)
    {
        $query = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->Connector->getConnection()->prepare($query);
        $stmt->execute([$id]);
    }
}

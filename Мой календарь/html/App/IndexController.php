<?php

namespace App;

use App\Database\TaskTable;
use App\View;
use App\Request;

class IndexController
{
    protected $View;
    protected $Request;
    protected $TaskTable;
    protected $allowed_data;


    public function __construct()
    {
        $this->View = new View;
        $this->Request = new Request;
        $this->TaskTable = TaskTable::getInstance();
    }
    public function show()
    {
        $getData = $this->Request->getGetData();
        if (isset($getData['date'])) {
            switch ($getData['date']) {
                case 'today':
                    $getData["date"] = date("Y-m-d", time());
                    break;
                case 'tomorrow':
                    $getData["date"] = date("Y-m-d", strtotime('tomorrow'));;
                    break;
                case 'this_week':
                    $getData["date"] = [date("Y-m-d", strtotime('this week')), date("Y-m-d",  strtotime('+1 week'))];
                    break;
                case 'next_week':
                    $getData["date"] = [date("Y-m-d", strtotime('next week')), date("Y-m-d",  strtotime('+1 week'))];
                    break;
            }
            $taskList = $this->TaskTable->getTaskByDate($getData["date"]);
        } else {
            $taskList = $this->TaskTable->getTasks();
        }

        $this->View->render('tasklist', ['taskList' => $taskList]);
    }
    public function store()
    {
        $postData = $this->Request->getPostData();
        var_dump($postData);
        list($errors, $vpostData) = $this->validate($postData);
        // var_dump($postData);
        if (!empty($errors)) {
            // echo 'bad';
            // var_dump($errors);
        } else {
            // echo 'good';
            $this->TaskTable->insertTask($vpostData);
        }
        header("Refresh:0");
    }
    protected function validate(array $getData)
    {

        $data = [
            "type" => '',
            "name" => '',
            "place" => '',
            "date" => '',
            "time" => '',
            "theme" => '',
            "duration" => '',
            "comment" => '',
        ];

        $errors = [];

        if (!empty($getData["name"])) {
            $data["name"] = strip_tags($getData["name"]);
        } else {
            $errors[] = "Не указано имя!";
        };

        if (!empty($getData["type"])) {
            $data["type"] = strip_tags($getData["type"]);
        } else {
            $errors[] = "Не указана фамилия!";
        };

        $data["place"] = strip_tags($getData["place"]);

        if (!empty($getData["date"])) {
            $data["date"] = strip_tags($getData["date"]);
        } else {
            $errors[] = "Не указан телефон!";
        };
        if (!empty($getData["time"])) {
            $data["time"] = strip_tags($getData["time"]);
        } else {
            $errors[] = "Не указан телефон!";
        };
        if (!empty($getData["done"])) {
            $data["done"] = 1;
        } else {
            $data["done"] = 0;
        }
        $data["duration"] = strip_tags($getData["duration"]);
        $data["comment"] = strip_tags($getData["comment"]);


        return [$errors, $data];
    }
}

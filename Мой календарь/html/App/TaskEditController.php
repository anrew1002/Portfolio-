<?php

namespace App;

use App\Database\TaskTable;
use App\View;
use App\Request;
use App\IndexController;

class TaskEditController extends IndexController
{
    public function show()
    {
        $getData = $this->Request->getGetData();
        // echo $getData["id"];
        $task = $this->TaskTable->getTasks($getData["id"])[0];
        // print_r($task);
        // echo $task["place"];
        $this->View->render('edit_task', ['task' => $task]);
    }
    public function store()
    {

        $getData = $this->Request->getGetData();
        $postData = $this->Request->getPostData();
        list($errors, $postData) = $this->validate($postData);
        if (!empty($errors)) {
            //
        } else {
            // var_dump($postData);
            // var_dump($getData);
            $this->TaskTable->updateTask($postData, $getData['id']);
        }
        header("Location: index.php");
    }
    public function delete()
    {
        $getData = $this->Request->getGetData();
        $postData = $this->Request->getPostData();
        $this->TaskTable->deleteTask($getData['id']);
    }
}

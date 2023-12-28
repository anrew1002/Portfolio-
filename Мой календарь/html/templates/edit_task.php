<?php

use App\View;

$View = new View;
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="static/css/new_task.css">
    <link rel="stylesheet" href="static/css/init.css">
</head>

<body>
    <?php
    $View->render('tasklist_partials/new_task_input', ['task' => $task, 'edit_flag' => true]);
    ?>

</body>

</html>
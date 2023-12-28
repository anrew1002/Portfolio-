<?php

use App\View;

$View = new View;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEAD</title>
    <link rel="stylesheet" href="static/css/index.css">
    <link rel="stylesheet" href="static/css/index_tabs.css">
    <link rel="stylesheet" href="static/css/init.css">
    <link rel="stylesheet" href="static/css/new_task.css">
</head>

<body>
    <form class='logout-form' action="logout.php" method="GET">
        <div><input type="submit" value="Выйти"></div>
    </form>
    <main>
        <?php $View->render('tasklist_partials/new_task_input', []) ?>

        <div class="task_list">
            <ul class="tabs" role="tablist">
                <li>
                    <input type="radio" name="tabs" id="tab1" checked />
                    <label for="tab1" role="tab" aria-selected="true" aria-controls="panel1">ВСЕ</label>
                    <div id="tab-content1" class="tab-content" role="tabpanel" aria-labelledby="description" aria-hidden="false">
                        <form action="" method="GET">
                            <input type="date" id="task_date" name="date"></input>
                            <input type="submit" class="btn-enter" value="↪"></input>
                        </form>
                        <a href="?date=today">сегодня</a>
                        <a href="?date=tomorrow">завтра</a>
                        <a href="?date=this_week">на эту неделю</a>
                        <a href="?date=next_week">на след неделю</a>
                        <table class="task_list__table" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>type </td>
                                    <td>task </td>
                                    <td>place </td>
                                    <td>date </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($taskList as $task => $discription) {
                                    $View->render('tasklist_partials/task_item', ['discription' => $discription]);
                                }
                                // print_r($taskList);
                                ?>
                            </tbody>
                        </table>
                        <?php
                        if (empty($taskList)) {
                            echo "<p>Вы еще не добавили ни одной задачи</p>";
                        }
                        ?>

                </li>

                <li>
                    <input type="radio" name="tabs" id="tab2" />
                    <label for="tab2" role="tab" aria-selected="false" aria-controls="panel2">
                        ТЕКУЩИЕ</label>
                    <div id="tab-content2" class="tab-content" role="tabpanel" aria-labelledby="specification" aria-hidden="true">
                        <a href="">сегодня</a>
                        <a href="">завтра</a>
                        <a href="">на эту неделю</a>
                        <a href="">на след неделю</a>
                        <table class="task_list__table" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>type </td>
                                    <td>task </td>
                                    <td>place </td>
                                    <td>date </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($taskList as $task => $discription) {
                                    // echo "<br>";
                                    // echo strtotime($discription['date']);
                                    // echo ' ' . $discription['date'];
                                    // echo "<br>";
                                    // echo time() . " " . date("Y-m-d H:i:s", time());
                                    // echo "<br>";
                                    if (strtotime($discription['date']) > time())
                                        $View->render('tasklist_partials/task_item', ['discription' => $discription]);
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php


                        ?>
                    </div>

                </li>

                <li>
                    <input type="radio" name="tabs" id="tab3" />
                    <label for="tab3" role="tab" aria-selected="false" aria-controls="panel3">ВЫПОЛНЕННЫЕ</label>
                    <div id="tab-content3" class="tab-content" role="tabpanel" aria-labelledby="specification" aria-hidden="true">

                        <table class="task_list__table" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>type </td>
                                    <td>task </td>
                                    <td>place </td>
                                    <td>date </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($taskList as $task => $discription) {
                                    // echo "<br>";
                                    // echo strtotime($discription['date']);
                                    // echo ' ' . $discription['date'];
                                    // echo "<br>";
                                    // echo time() . " " . date("Y-m-d H:i:s", time());
                                    // echo "<br>";
                                    if ($discription['done'] == 1)
                                        $View->render('tasklist_partials/task_item', ['discription' => $discription]);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </li>
                <li>
                    <input type="radio" name="tabs" id="tab4" />
                    <label for="tab4" role="tab" aria-selected="false" aria-controls="panel3">ПРОСРОК</label>
                    <div id="tab-content3" class="tab-content" role="tabpanel" aria-labelledby="specification" aria-hidden="true">

                        <table class="task_list__table" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>type </td>
                                    <td>task </td>
                                    <td>place </td>
                                    <td>date </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($taskList as $task => $discription) {
                                    if ($discription['done'] == 0 && strtotime($discription['date']) < time())
                                        $View->render('tasklist_partials/task_item', ['discription' => $discription]);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </li>
            </ul>

        </div>
    </main>




</body>

</html>
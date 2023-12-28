<div class="new_task">
    <form class='cancel-form' action="index.php" method="GET">
        <div><input type="submit" value="Отмена"></div>
    </form>
    <?php if (!empty($edit_flag)) {
        echo "<form class='delete_form' action='' method='POST'>    
        <div>
        <div><input type='hidden' name='delete' value='1' ></div>
        <div><input type='submit' value='Удалить'></div>
        </div>
        </form>";
    }
    ?>
    <form class='new_task__table' action="" method="POST">
        <div>
            <label class="desc" for="theme">Тема</label>
            <div>
                <input id="theme" name="name" type="text" class="field text fn" value='<?= $task["name"] ?? " " ?>'>
            </div>
        </div>
        <div>
            <label class="desc" for="type">
                Тип
            </label>
            <div>
                <select id="type" name="type" class="field select medium">
                    <option value="1">Встреча</option>
                    <option value="2">Звонок</option>
                    <option value="3">Совещание</option>
                    <option value="4">Дело</option>
                </select>
            </div>
        </div>
        <div>
            <label class="desc" for="place">
                Место
            </label>
            <div>
                <input id="place" name="place" type="text" spellcheck="false" value='<?= $task["place"] ?? "" ?>' maxlength="255">
            </div>
        </div>
        <div>
            <label class="desc" for="date">
                Дата и время
            </label>
            <div class='datetime'>
                <input type="date" id="date" name="date" value='<?= explode(" ", $task["date"])[0] ?? " " ?>'></input>
                <input type="time" id="time" name="time" value='<?= explode(" ", $task["date"])[1] ?? " " ?>'> </input>
            </div>
        </div>
        <div>
            <label class="desc" for="duration">
                Длительность
            </label>
            <div>
                <input type="time" id="duration" name="duration" value='<?= $task["duration"] ?? " " ?>'></input>
            </div>
        </div>

        <div>
            <label class="desc" for="comment">
                Комментарий
            </label>

            <div>
                <textarea id="comment" name="comment" spellcheck="true" rows="10" cols="50"><?= $task["comment"] ?? " " ?></textarea>
            </div>
        </div>
        <div>
            <label class="desc" for="done">
                Выполненно
            </label>
            <div>
                <input type='checkbox' name='done' id='done' <?= isset($task) && $task["done"] = 1 ? 'checked' : " " ?>> </input>
            </div>
        </div>
        <div>
            <div><input type="submit" value="Cохранить"></div>
        </div>

    </form>


</div>
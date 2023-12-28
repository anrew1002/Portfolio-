<?php
session_start();

date_default_timezone_set('Asia/Irkutsk');
spl_autoload_register(function ($classname) {
    include dirname(__FILE__) . "/" . str_replace("\\", "/", $classname) . '.php';
});


function e(string $string)
{
    return htmlspecialchars($string);
}

function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
            <div class="alert">
                <?= $_SESSION['flash'] ?>
            </div>
<?php }
        unset($_SESSION['flash']);
    }
}

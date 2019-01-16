<?php

require_once './app/config/config.php';
require_once CONFIG_PATH.'classes_autoloader.php';

if (isset($_GET['case']) && $_GET['case'] === 'logout') {

    SESSION::destroy();
    $redirect = 'index.php?case=logout';


}else {

    $USER = new USER;
    $redirect = 'index.php?case=wrong';

    if ($USER->login()) {

        SESSION::start();
        $_SESSION['user'] = [
            'name' => $USER->getName()
        ];
        $redirect = '*';

    }

}

HELPER::redirect($redirect);
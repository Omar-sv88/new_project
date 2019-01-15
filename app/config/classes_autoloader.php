<?php

require_once './app/config/config.php';

spl_autoload_register (function($class){
    if(file_exists(CLASSES_PATH.$class.'.php')){
        require_once CLASSES_PATH.$class.'.php';
    }
});
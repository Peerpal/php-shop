<?php

require_once 'config.php';

function loadView($class) {
    require_once "lib/{$class}.php";
}


//function loadEntities($class) {
//    require_once "entities/{$class}.php";
//}
//
//function loadDatabase($class) {
//    require_once "database/{$class}.php";
//}

//spl_autoload_register('loadDatabase');
spl_autoload_register('loadView');
//spl_autoload_register('loadEntities');
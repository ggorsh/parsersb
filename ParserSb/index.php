<?php
require_once 'SbParser.php';
require_once 'Model.php';
require_once 'View.php';
require_once 'Controller.php';
// данные передаются через GET запрос вида ?date=dd/mm/yyyy

$model = new Model();
$view = new View();
$controller = new Controller($model,$view);

if (isset($_GET['date']) && !empty($_GET['date'])) {
    $controller->getData($_GET['date']);
}



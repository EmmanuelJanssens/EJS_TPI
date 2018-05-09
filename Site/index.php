<?php

    include_once "view/view.php";
    include_once "controller/controller.php";
    include_once "model/model.php";


    $view = new View();
    $model = new Model($view);
    $controller = new Controller($model,$view);

    
    $GLOBALS['model'] = $model;
    $GLOBALS['controller'] = $controller;
    $GLOBALS['view'] = $view;

    if( isset($_GET['action']) &&   !empty($_GET['action']))
    {
        $action = $_GET['action'];
        $controller->{$action}();
    }

    echo $view->default_page();


?>
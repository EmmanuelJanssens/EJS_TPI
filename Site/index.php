<?php
    session_start();

    require_once "Controller/Controller.php";

    $controller = new Controller();
    $GLOBALS['controller'] = $controller;


    require_once "Controller/UserController.php";
    $UserController = new UserController();
    $GLOBALS['userController'] = $UserController;

    try
    {       
        if(isset($_GET['action']))
        {
            //Get the action
            $action = $_GET['action'];

            //Check wich action the user choosed to do
            switch($action)
            {
                case "view_home":
                    $controller->ViewHome();
                break;
                
                case "view_project":
                    $controller->ViewProjects();
                break;

                case "view_forum":
                    $controller->ViewForums();
                break;

                case "view_about":
                    $controller->ViewAbout();
                break;
                
                case "user_login":
                    $UserController->Login();
                break;

                case "user_logout":
                    $UserController->Logout();
                break;
                
                case "user_register":
                    $UserController->Register();
                break;
                
                case "view_user_register":
                    $UserController->ViewRegister();
                break;
                case "view_user_login":
                    $UserController->ViewLogin();
                break;         

                case "view_user_logout":
                    $UserController->Logout();
                break;

                case "view_user_profile":
                    $UserController->ViewProfile();
                break;

                default:
                    //if no action was passed the default page will be displayed
                    $controller->ViewHome();
                break;
            }
        }
        else
        {
            //Default page
            $controller->ViewHome();
        }

    }
    catch(Exception $ex)
    {
        
    }
?>
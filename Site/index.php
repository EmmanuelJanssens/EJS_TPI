<?php
    session_start();

    require_once "Controller/Controller.php";
    require_once "Controller/UserController.php";

    require_once "DAO/UserDAO.php";

    $controller = new Controller($BaseDAO = new DAO());
    $GLOBALS['controller'] = $controller;

    $UserDAO = new UserDAO;
    $UserController = new UserController($UserDAO);
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
                    extract($_POST);
                    $UserController->Login($username,$password);
                break;

                case "user_logout":
                    $UserController->Logout();
                break;
                
                case "user_register":
                    extract($_POST);
                    $UserController->Register($name,$lastname,$username,$email,$password,$passwordconfirm);
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
                
                case "view_user_project":
                    $projectID = $_GET['projectID'];
                    $UserController->ViewUserProject($projectID);
                break;

                case "view_user_version":
                    $UserController->ViewUserVersion(1,1);
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
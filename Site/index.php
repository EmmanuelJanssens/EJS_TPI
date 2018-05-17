<?php
    session_start();

    require_once "Controller/Controller.php";
    
    require_once "Controller/UserController.php";
    require_once "Controller/ProjectController.php";
    require_once "Controller/VersionController.php";
    require_once "Controller/ForumController.php";

    require_once "DAO/UserDAO.php";
    require_once "DAO/ProjectDAO.php";
    require_once "DAO/VersionDAO.php";
    require_once "DAO/ForumDAO.php";


    //Database Access
    $BaseDAO = new DAO();
    $UserDAO = new UserDAO();
    $ProjectDAO = new ProjectDAO();
    $VersionDAO = new VersionDAO();
    $ForumDAO = new ForumDAO();

    //Controllers
    $controller = new Controller($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $UserController = new UserController($controller);
    $UserController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $ProjectController = new ProjectController($controller);
    $ProjectController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $VersionController = new VersionController($controller);
    $VersionController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $ForumController = new ForumController($controller);
    $ForumController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    
    //Initialisation

    $GLOBALS['controller'] = $controller;
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
                    $ProjectController->ViewAllProjects(3);
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
                    $user = $_GET['userID'];
                    $UserController->ViewProfile($user);
                break;
                
                case "view_user_project":
                    $projectID = $_GET['projectID'];
                    $ProjectController->ViewProject($projectID);
                break;

                case "view_user_version":
                    $versionID = $_GET['versionID'];
                    $VersionController->ViewUserVersion($versionID);
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
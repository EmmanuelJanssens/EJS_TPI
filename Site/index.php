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

    require_once "FTPHandler.php";
    
    //Database Access
    $BaseDAO = new DAO();
    $UserDAO = new UserDAO();
    $ProjectDAO = new ProjectDAO();
    $VersionDAO = new VersionDAO();
    $ForumDAO = new ForumDAO();




    //Controllers
    $controller = new Controller($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $userController = new UserController($controller);
    $userController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);



    $ProjectController = new ProjectController($controller);
    $ProjectController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $VersionController = new VersionController($controller);
    $VersionController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    $ForumController = new ForumController($controller);
    $ForumController->Init($BaseDAO,$UserDAO,$ProjectDAO,$VersionDAO,$ForumDAO);

    
    $FTPHandler = new FTPHandler("192.168.154.130",'FTP','Pa$$w0rd');


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
                    $userController->Login($username,$password);
                break;

                case "user_logout":
                    $userController->Logout();
                break;
                
                case "user_register":
                    extract($_POST);
                    $userController->Register($name,$lastname,$username,$email,$password,$passwordconfirm,$FTPHandler);
                break;
                
                case "view_user_register":
                    $userController->ViewRegister();
                break;
                case "view_user_login":
                    $userController->ViewLogin();
                break;         

                case "view_user_logout":
                    $userController->Logout();
                break;

                case "view_user_profile":
                    $user = $_GET['username'];
                    $userController->ViewProfile($user);
                break;
                
                case "view_user_project":
                    $username = $_GET['username'];
                    $projectid = $_GET['projectID'];
                    $ProjectController->ViewProject($username,$projectid);
                break;

                case "view_user_version":
                    $versionID = $_GET['versionID'];
                    $username = $_GET['username'];
                    $VersionController->ViewUserVersion($username,$versionID,$FTPHandler);
                break;

                case "user_create_project":
                    $userController->CreateProjectForm();
                    break;
                case "create_project":
                    extract($_POST);
                    $ProjectController->CreateProject($projectname,$projectdescription);
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
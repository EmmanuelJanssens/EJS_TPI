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

    
    $FTPHandler = new FTPHandler("192.168.154.132",'FTP','','Pa$$w0rd');


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
                    $controller->ViewHome(4);
                break;
                
                case "view_project":
                    $ProjectController->ViewAllProjects(20);
                break;

                case "view_forum":
                    $ForumController->ViewForums(20);
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
                    $userName = $_GET['username'];
                    $projectID = $_GET['projectID'];
                    $ProjectController->ViewProject($userName,$projectID);
                break;

                case "view_user_version":
                    $versionID = $_GET['versionID'];
                    $userName = $_GET['username'];
                    $VersionController->ViewUserVersion($userName,$versionID,$FTPHandler);
                break;

                case "user_create_project":
                    $userController->CreateProjectForm();
                    break;
                case "create_project":
                    extract($_POST);
                    $ProjectController->CreateProject($projectname,$projectdescription,$FTPHandler);
                    break;
                case "user_upload_version";
                    $userController->UploadVersionForm();
                    break;
                case "upload_version";
                    extract($_POST);
                    $VersionController->UploadVersion($versionname,$versiondescription,$versionlog,$_FILES['fileToUpload'],$projectID,$FTPHandler);
                    break;
                case "view_project_topic":
                    extract($_GET);
                    $ForumController->DisplayMessage($projectID);
                    break;
                case "update_project":
                    $username = $_GET['username'];
                    $projectID = $_GET['projectID'];
                    $ProjectController->ViewProject($username,$projectID);
                    break;
                case "save_project":
                    $username = $_GET['username'];
                    $projectID = $_GET['projectID'];
                    $projectName = $_POST['projectName'];
                    $projectDecription =$_POST['projectDescription'];
                    $ProjectController->UpdateProject($projectName,$projectID,$projectDecription,$username);
                    break;
                case "delete_project":
                    $user = $_GET['username'];
                    $projectID = $_GET['projectID'];
                    $ProjectController->DeleteProject($projectID,$user,$FTPHandler);
                    break;
                case "manage_all_user":
                    $userController->DisplayAllUsers();
                    break;
                case "admin_start_user_update":
                    $userController->DisplayAllUsers();
                    break;
                case "admin_user_update":
                    extract($_POST);
                    $userController->SaveUpdatedUser($userID,$name,$lastName,$username,$email,$password,$userType);
                    break;
                case "admin_delete_user":
                    $user = $_GET['userName'];
                    $userController->DeleteUser($user,$FTPHandler);
                    break;
                case "user_post_message":
                    extract($_POST);
                    $ForumController->PostMessage($date,$userName,$projectID,$message);
                    break;
                case "forgot_password":
                    $userController->DisplayNewPasswordForm();
                    break;
                case "send_new_password":
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $userController->SendNewPassword($username,$email);
                    break;

                case "user_update_password":
                    $userController->DisplayUpdatePasswordForm();
                    break;
                case "update_user_password":
                    extract($_POST);
                    $userController->UpdateUserPassword($user,$password,$confirmation);
                    break;
                default:
                    //if no action was passed the default page will be displayed
                    $controller->ViewHome(4);
                break;
            }
        }
        else
        {
            //Default page
            $controller->ViewHome(4);
        }

    }
    catch(Exception $ex)
    {
        
    }
    ?>
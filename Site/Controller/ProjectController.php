<?php
    require_once "Controller.php";

    /**
     * @brief controls all the project's functionalities such as creating, displaying deleting
    **/
    class ProjectController extends Controller
    {
        /**
         * @brief basic constructor
        **/
        function __construct()
        {
            
        }

        /**
         * ViewProject
         *
         * @brief Displays a list of all the project
         * @param [int] $limit limits the number of project to be displayed
         */
        function ViewAllProjects($limit)
        {
            $projectData = $this->projectDAO->GetAllProject($limit);

            $error = $this->projectDAO->error;
            require_once "View/AllProjectView.php";
        }

        /**
         * @brief displays a project's content, description, versions, and accessibility if the user is the creator of the project
         *
         * @param [string] $username creator of the project
         * @param [int] $projectid ID of the project
        **/
        function ViewProject($userName,$projectID)
        {
            //Get the data from the specified project by ID
            $projectData = $this->projectDAO->GetProjectDetails($userName,$projectID);

            //Get a list of all the versions from the project
            $versionList = $this->versionDAO->GetVersionList($userName);

            $messageList = $this->forumDAO->GetProjectMessage($projectID);

            require_once "View/User/UserProjectView.php";
        }

        /**
         * @brief Create a project
         *
         * @param [string] $name name of the project
         * @param [string] $description description of the project
         * @param [FTPHandler] $ftp file stream to be used to handle folder creation on the server
        **/
        function CreateProject($name,$description,$ftp)
        {

            $id = $this->projectDAO->CreateProject($name,$description);

            if($id > 0)
            {
                $user = $_SESSION['user_session']['username'];
                $ftp->CreateDirectory($user.'/'.$name);
                header("Location: index.php?action=view_user_project&username=".$user."&projectID=".$id) ;
            }
            else
            {
                $error = $this->projectDAO->error;
                require_once "View/User/UserProfileView.php";
            }

        }

        /**
         * @brief Updates a project
         *
         * @param [string] $projectName name of the project to be updated
         * @param [int] $projectID ID of the project to be updated
         * @param [string] $description description of the object to be changed
         * @param [string] $username $current to get the current user that is connected
        **/
        function UpdateProject($projectName,$projectID,$description,$username)
        {

            $this->projectDAO->UpdateProject($projectName,$projectID,$description,$username);

            //Get the data that was updated

            //Get the data from the specified project by ID
            $projectData = $this->projectDAO->GetProjectDetails($username,$projectID);

            //Get a list of all the versions from the project
            $versionList = $this->versionDAO->GetVersionList($username);

            $messageList = $this->forumDAO->GetProjectMessage($projectID);

            require_once "View/User/UserProjectView.php";
        }

        /**
         * @brief Delete a project from the website as well from the database
         *
         * @param [int] $projectID id of the project to be deleted
         * @param [string] $user to know in wich directory the project is
         * @param [FTPHandler] $ftp file stream to be used
        **/
        function DeleteProject($projectID,$user, $ftp)
        {
            $projectname = $this->projectDAO->GetProjectName($projectID);
            $ftp->DeleteDirectory("$user/$projectname");

            //Delete
            $this->projectDAO->DeleteProject($projectID);
            $error = $this->projectDAO->error ;

            //Get informations about a project list
            $userData = $this->userDAO->GetUserProjectList($user);


            //Get information about messages
            $userID = $this->userDAO->GetIDByUserName($user);
            $userMessages = $this->forumDAO->GetUserMessage($userID);



            require_once "View/User/UserProfileView.php";
        }
    }
?>
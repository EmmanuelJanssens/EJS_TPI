<?php
    require_once "Controller.php";
    class ProjectController extends Controller
    {
        function __construct()
        {
            
        }

        /**
         * ViewProject
         *
         * @brief Displays a list of all the project
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        function ViewAllProjects($limit)
        {
            $projectData = $this->projectDAO->GetAllProject($limit);

            $error = $this->projectDAO->error;
            require_once "View/AllProjectView.php";
        }
        function ViewProject($username,$projectid)
        {
            //Get the data from the specified project by ID
            $projectData = $this->projectDAO->GetProjectDetails($username,$projectid);

            //Get a list of all the versions from the project
            $versionList = $this->versionDAO->GetVersionList($username);

            require_once "View/User/UserProjectView.php";
        }

        function ViewVersion($projectid,$Version)
        {
            require_once "View/User/UserVersionView.php";
        }

        function CreateProject($name,$description)
        {

            $this->projectDAO>$this->CreateProject($name,$description);
            require_once "View/User/UserProfileView.php";
        }
    }
?>
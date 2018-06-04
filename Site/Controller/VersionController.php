<?php

    require_once "Controller.php";

    /**
     * @brief controls the version such as displaying, updating, uploading, deleting
    **/
    class VersionController extends Controller
    {

        /**
         * @brief basic constructor
        **/
        function __construct()
        {

        }

        /**
         * @brief Get information about the selected version
         *
         * @param [string] $username author of the version
         * @param [int] $versionID id of the version that is updated
         * @param [FTPHandler] $FTPHandler file stream to display the version's directory's content
         **/
        function ViewUserVersion($username,$versionID,$FTPHandler)
        {
            $versionData = $this->versionDAO->GetVersionDetails($versionID);

            $versionName = $versionData[0]->title;
            $projectName = $this->projectDAO->GetProjectName($versionData[0]->fkProject);

            $FILES = $FTPHandler-> GetFileList($username."/".$projectName."/".$versionName);

            require_once "View/User/UserVersionView.php";
        }

        /**
         * @brief Creates a version and uploads files to the database
         *
         * @param [string] $name name of the version
         * @param [string] $description description of the version
         * @param [string] $log devlog of the version
         * @param [file] $file file that was chosen to be uploaded
         * @param [string] $project name of the project in wich the version will be created
         * @param [FTPHandler] $ftp file stream that will be used to create the directory on the server
        **/
        function UploadVersion($name,$description,$log,$file,$project,$ftp)
        {
            $versionID  = $this->versionDAO->CreateVersion($name,$description,$log,$file,$project) ;
            if($versionID> 0)
            {
                $username = $this->userDAO->GetCurrentUser();
                $projectName = $this->projectDAO->GetProjectName($project);
                $ftp->CreateDirectory($username."/".$projectName."/".$name);

                $ftp->Upload($file,$username."/".$projectName."/".$name."/");

                //$ftp->CreateVresion("var/www/EJSTPI/",$this->userDAO->GetCurrentUser(),$this->projectDAO->GetProjectName($project));
                $versionData = $this->versionDAO->GetVersionDetails($versionID);
                $FILES = $ftp-> GetFileList($username."/".$projectName."/".$name);


                require_once "View/User/UserVersionView.php";
            }
        }

    }
?>
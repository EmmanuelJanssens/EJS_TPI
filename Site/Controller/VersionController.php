<?php

    require_once "Controller.php";

    class VersionController extends Controller
    {

        function __construct()
        {

        }

        /**
         * @brief Get information about the selected version
         *
         * TODO Display all files and directories as links and if it is a directory create a link to the directory's content, It may be best using Some AJAX to avoid reloading the project page too much
         *
         **/
        function ViewUserVersion($username,$versionID,$FTPHandler)
        {
            $versionData = $this->versionDAO->GetVersionDetails($versionID);

            $versionName = $versionData[0]->title;
            $projectName = $this->projectDAO->GetProjectName($versionData[0]->fkProject);

            $FILES = $FTPHandler-> GetFileList("/var/www/EJSTPI/data/$username/$projectName/$versionName");

            require_once "View/User/UserVersionView.php";
        }


        function UploadVersion($name,$description,$log,$file,$project,FTPHandler $ftp)
        {
            $versionID  = $this->versionDAO->CreateVersion($name,$description,$log,$file,$project) ;
            if($versionID> 0)
            {
                $username = $this->userDAO->GetCurrentUser();
                $projectName = $this->projectDAO->GetProjectName($project);
                $ftp->CreateDirectory("/var/www/EJSTPI/data/$username/$projectName/$name");

                //$ftp->CreateVresion("var/www/EJSTPI/",$this->userDAO->GetCurrentUser(),$this->projectDAO->GetProjectName($project));
                $versionData = $this->versionDAO->GetVersionDetails($versionID);
                $FILES = $ftp-> GetFileList("/var/www/EJSTPI/data/$username/$projectName/$name");


                require_once "View/User/UserVersionView.php";
            }
        }

    }
?>
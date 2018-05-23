<?php

    require_once "Controller.php";

    class VersionController extends Controller
    {
        private $DAO;
        
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

            $FILES = $FTPHandler-> GetFileList("/var/www/EJSTPI/data/$username",$versionID);
            $versionData = $this->versionDAO->GetVersionDetails($versionID);

            require_once "View/User/UserVersionView.php";
        }

    }
?>
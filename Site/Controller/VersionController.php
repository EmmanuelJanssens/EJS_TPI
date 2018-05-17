<?php

    require_once "Controller.php";

    class VersionController extends Controller
    {
        private $DAO;
        
        function __construct()
        {

        }

       
        function ViewUserVersion($versionID)
        {
            $versionData = $this->versionDAO->GetVersionDetails($versionID);
            
            require_once "View/User/UserVersionView.php";
        }
    }
?>
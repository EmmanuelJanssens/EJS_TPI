<?php
    require_once "BaseDAO.php";


    /**
     * @brief acces the database for the version control
    **/
    class VersionDAO extends DAO 
    {

        /**
         * Get a list of the version from the user
         *
         * @param [int] id of the user
         * @param [int] id of the project to display versions
         *
         * @return  array of version
        **/
        function GetVersionList($userID,$projectID)
        {
            try
            {
                $conn = $this->connect();

                $q = "SELECT Version.pkVersion, Version.title,  Project.name, User.username from Version inner join Project on Version.fkProject = :projectID inner join User on Project.fkUser = User.pkUser WHERE User.username = :username";

                $query = $conn->prepare($q);
                $query->bindParam(":projectID",$projectID,PDO::PARAM_INT);
                $query->bindParam(":username",$userID,PDO::PARAM_INT);
                $query->execute();
                
                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                return $result;
            }
            catch(Exception$e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }     

        /**
         * @brief get an entry of a specific version
         *
         * @param [int] $versionID id of the version to get from the database
         *
         * @return array entry of the database
        **/
        function GetVersionDetails($versionID)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT pkVersion,title,DevLog,description,fkState,fkProject FROM Version WHERE :versionID = pkVersion");
                $query->bindParam(":versionID",$versionID,PDO::PARAM_INT);
                $query->execute();
                
                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                return $result;
            }
            catch(Exception$e)
            {
                $this->error = $e->getMessage();
                return null;
            }                     
        }

        /**
         *
         * @brief creates an entry in the database
         *
         * @param [string] $name name of the version
         * @param [string] $description $description of the version
         * @param [string] $log $log of the version
         * @param [string] $file $file that was uploaded
         * @param [string] $project $project that contains the version
         *
         * @return int last inserted version
        **/
        function CreateVersion($name,$description,$log,$file,$project)
        {
            try
            {
                $user = $_SESSION['user_session'];

                $conn = $this->connect();

                $qs = "INSERT INTO Version(title,description,devLog,fkState,fkProject) VALUES (:title,:description,:log,:state,:project)";
                $query = $conn->prepare($qs);

                $state =1;
                $query->bindParam(":title",$name);
                $query->bindParam(":description",$description);
                $query->bindParam(":log",$log);
                $query->bindParam(":state",$state);
                $query->bindParam(":project",$project);

                $query->execute();

                return $conn->lastInsertId();

            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return 0;
            }
        }
    }
?>
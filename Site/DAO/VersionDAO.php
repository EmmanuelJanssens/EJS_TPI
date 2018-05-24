<?php
    require_once "BaseDAO.php";

    class VersionDAO extends DAO 
    {
        function GetVersionList($username)
        {
            try
            {
                $conn = $this->connect();

                $q = "SELECT Version.pkVersion, Version.title,  Project.name, User.username from Version inner join Project on Version.fkProject = Project.pkProject inner join User on Project.fkUser = User.pkUser WHERE User.username = :username";

                $query = $conn->prepare($q);
                $query->bindParam(":username",$username,PDO::PARAM_INT);
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
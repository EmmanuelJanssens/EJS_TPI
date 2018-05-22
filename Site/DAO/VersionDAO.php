<?php
    require_once "BaseDAO.php";

    class VersionDAO extends DAO 
    {
        function GetVersionList($projectID)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT pkVersion,title FROM Version  WHERE :projectID = fkProject");
                $query->bindParam(":projectID",$projectID,PDO::PARAM_INT);
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
    }
?>
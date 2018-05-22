<?php
    require_once "BaseDAO.php";

    class ProjectDAO extends DAO
    {
        
        function GetAllProject($limit)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT pkProject,name,description,creationDate,root,topic,fkUser FROM Project");
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
        function GetProjectDetails($ProjectID)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT pkProject,description,creationDate,root,topic,name FROM Project WHERE :projectID = pkProject");
                $query->bindParam(":projectID",$ProjectID,PDO::PARAM_INT);
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
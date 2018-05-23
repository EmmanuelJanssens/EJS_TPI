<?php
    require_once "BaseDAO.php";

    class ProjectDAO extends DAO
    {
        
        function GetAllProject($limit)
        {
            try
            {
                $conn = $this->connect();

                $q = "SELECT Project.pkProject,Project.description, Project.name, Project.creationDate, User.username FROM Project INNER JOIN User ON Project.fkUser = User.pkUser";
                $query = $conn->prepare($q);
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
        function GetProjectDetails($username,$projectid)
        {
            try
            {
                $conn = $this->connect();

                $q = "SELECT Project.pkProject, Project.description, Project.CreationDate, Project.root, Project.topic, Project.name FROM Project INNER JOIN User ON Project.fkUser = User.pkUser WHERE User.username = :username AND Project.pkProject = :projectid";
                $query = $conn->prepare($q);
                $query->bindParam(":projectid",$projectid,PDO::PARAM_INT);
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

        function CreateProject($name,$description)
        {
            try
            {
                $user = $GLOBALS['user_session'];
                $creation_data = date("y-m-d");
                $root = "/var/www/EJSTPI";
                $topic = "Topic of $name";

                $conn = $this->connect();

                $qs = "INSERT INTO Project(name,description,creationDate,root,topic,fkUser) VALUES (:name,:description,:creationdate,:root,:topic,:creator)";

                $query = $conn->prepare($qs);

                $query->bindParam(":name",$name);
                $query->bindParam(":description",$description);
                $query->bindParam(":creationDate",$creation_data);
                $query->bindParam(":root",$root);
                $query->bindParam(":topic",$topic);
                $query->bindParam(":creator",$user["userid"]);

                $query->execute();

                return true;

            }
            catch(Exception $e)
            {
                return false;
            }

        }
    }
?>
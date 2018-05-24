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

                $q = "SELECT Project.pkProject, Project.description, Project.CreationDate, Project.root, Project.topic, Project.name, User.username FROM Project INNER JOIN User ON Project.fkUser = User.pkUser WHERE User.username = :username AND Project.pkProject = :projectid";
                $query = $conn->prepare($q);
                $query->bindParam(":projectid",$projectid,PDO::PARAM_INT);
                $query->bindParam(":username",$username,PDO::PARAM_STR);

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
        function GetProjectAuthor($project)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT User.username,fkUser from Project INNER JOIN User ON fkUser = pkUser WHERE pkProject = :ID";
                $query = $conn->prepare($qs);

                $query->bindParam(":ID",$project);

                $query->execute();

                $result = array();
                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                return $result;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }
        function GetProjectName($ID)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT name from Project WHERE pkProject = :ID";
                $query = $conn->prepare($qs);

                $query->bindParam(":ID",$ID);

                $query->execute();

                $result = array();
                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                return $result[0]->name;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }
        function CreateProject($name,$description)
        {
            try
            {
                $user = $_SESSION['user_session'];
                $creation_data = date("Y-m-d");
                $root = "/var/www/EJSTPI";
                $topic = "Topic of $name";

                $conn = $this->connect();

                $qs = "INSERT INTO Project(name,description,creationDate,root,topic,fkUser) VALUES (:name,:description,:creationdate,:root,:topic,:creator)";

                $query = $conn->prepare($qs);

                $query->bindParam(":name",$name);
                $query->bindParam(":description",$description);
                $query->bindParam(":creationdate",$creation_data);
                $query->bindParam(":root",$root);
                $query->bindParam(":topic",$topic);
                $query->bindParam(":creator",$user["userid"]);

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
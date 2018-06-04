<?php
    require_once "BaseDAO.php";

    /**
     *
     * @brief access data for the ProjectController
    **/
    class ProjectDAO extends DAO
    {

        /**
         * @brief get a list of all project to be displayed on the main project page
         *
         * @param [int] $limit How many rows does it return
         *
         * @return array of project limited by $limit
        **/
        function GetAllProject($limit)
        {
            try
            {
                $conn = $this->connect();

                $q = "SELECT Project.pkProject,Project.description, Project.name, Project.creationDate, User.username FROM Project INNER JOIN User ON Project.fkUser = User.pkUser ORDER BY Project.creationDate DESC LIMIT  $limit";
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

        /**
         * @brief get the details/content of the project
         *
         * @param [string] $username author of the project
         * @param [int] $project id id of the project to be displayed
         *
         * @return array a single entry of the project's details
        **/
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

        /**
         * @brief get the author of the specified project
         *
         * @param [int] $project id of the project to get the author
         *
         * @return array an single entry with the author from the desired project
         **/
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

        /**
         * @brief gets the name of the project BY ID
         *
         * @param [int] $ID id of the project
         *
         * @return string the name of the project
         **/
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

        /**
         * @brief insert an antry in the project table
         *
         * @param [string] $name name of the project
         * @param [string] $description description of the project
         *
         * @return int ID of the last inserted project
         **/
        function CreateProject($name,$description)
        {
            try
            {
                $user = $_SESSION['user_session'];
                $creation_date = date("Y-m-d h:i:s");
                $root = "/var/www/home/Users/$user";
                $topic = "Topic of $name";

                $conn = $this->connect();

                $qs = "INSERT INTO Project(name,description,creationDate,root,topic,fkUser) VALUES (:name,:description,:creationdate,:root,:topic,:creator)";

                $query = $conn->prepare($qs);

                $query->bindParam(":name",$name);
                $query->bindParam(":description",$description);
                $query->bindParam(":creationdate",$creation_date);
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

        /**
         * @brief updates the description, name, update date
         *
         * @param [string] $projectName name of the updated project
         * @param [int] $projectID id of the project that was updated
         * @param [description] $description description of the updated project
         * @param [string]
         **/
        function UpdateProject($projectName,$projectID,$description,$username)
        {
            try
            {
                $conn = $this->connect();


                $qs = "UPDATE Project SET name = :projectName, description =:description WHERE pkProject=:projectID";

                $query = $conn->prepare($qs);

                $query->bindParam(":projectName",$projectName);
                $query->bindParam(":projectID",$projectID);
                $query->bindParam(":description",$description);

                $query->execute();
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }

        /**
         * @brief deletes an entry in the project table
         *
         * @param [int] project id
        **/
        function DeleteProject($projectID)
        {
            try
            {
                $conn = $this->connect();

                //to avoid error in the data base due to constraints we need to delete every entry linked to the project
                $qs = "DELETE FROM Message WHERE fkProject=:projectID";
                $query = $conn->prepare($qs);
                $query->bindParam(":projectID",$projectID);
                $query->execute();

                $qs = "DELETE FROM Version WHERE fkProject=:projectID";
                $query = $conn->prepare($qs);
                $query->bindParam(":projectID",$projectID);
                $query->execute();

                $qs = "DELETE FROM Project WHERE pkProject=:projectID";
                $query = $conn->prepare($qs);
                $query->bindParam(":projectID",$projectID);
                $query->execute();

            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }
    }
?>
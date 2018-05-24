<?php
    require_once "BaseDAO.php";

    class ForumDAO extends DAO 
    {
        function GetAllTopics()
        {

            try
            {
                $conn = $this->connect();

                $qs = "SELECT * FROM Project";

                $query = $conn->prepare($qs);

                $query->execute();

                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                return $result;
            }
            catch (Exception $e)
            {

            }

        }

        public function GetProjectMessage($project)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT User.username,User.pkUser,Message.content,Message.date,Project.name as projectName FROM Message INNER JOIN Project ON Project.pkProject = Message.fkProject INNER JOIN User ON Message.fkUser = User.pkUser WHERE fkProject = :project";

                $query = $conn->prepare($qs);

                $query->bindParam(":project",$project);

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

        public function GetUserMessage($user)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT User.username,User.pkUser,Message.date , Project.name as projectName  FROM Message  INNER JOIN Project ON Message.fkProject = Project.pkProject INNER JOIN User ON Message.fkUser = User.pkUser WHERE Message.fkUser = :user ORDER BY date DESC LIMIT 5";

                $query = $conn->prepare($qs);

                $query->bindParam(":user",$user);

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
    }
?>
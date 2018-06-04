<?php
    require_once "BaseDAO.php";

    /**
     * @brief controls the data access to the forum's data
    **/
    class ForumDAO extends DAO 
    {

        /**
         * @brief get the data of all available list limited by $limit
         *
         * @param [int] limt of the topcis that will be displayed
         *
         * @return array an array of entries to be used in the view page
        **/
        function GetAllTopics($limit)
        {

            try
            {
                $conn = $this->connect();

                $qs = "SELECT * FROM Project LIMIT $limit";

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
                $this->error = $e->getMessage();
            }

        }

        /**
         * @brief get a list of message linked to the project
         *
         * @param [string] project that from wich the message will be displayed
         *
         * @return array an array of messages
        **/
        public function GetProjectMessage($project)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT Message.pkMessage, User.username,User.pkUser,Message.content,DATE_FORMAT(Message.date,'%d/%m/%Y %k:%i') as date ,Project.name as projectName FROM Message INNER JOIN Project ON Project.pkProject = Message.fkProject INNER JOIN User ON Message.fkUser = User.pkUser WHERE fkProject = :project";

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

        /**
         * @brief get a list of messages by a specific user
         *
         * @param [string] $user author of the message
         *
         * @return array an array of messages by the user
        **/
        public function GetUserMessage($user)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT Message.pkMessage,User.username,User.pkUser,DATE_FORMAT(Message.date,'%d/%m/%Y %k:%i') as date , Project.name as projectName ,Project.pkProject  FROM Message  INNER JOIN Project ON Message.fkProject = Project.pkProject INNER JOIN User ON Message.fkUser = User.pkUser WHERE Message.fkUser = :user ORDER BY date DESC LIMIT 5";

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

        /**
         * @brief writes new message entries in to the database
         *
         * @param [date] date on wich the message was posted
         * @param [int] id of the user that posted the message
         * @param [int] id project on wich the message was posted
         * @param [string] content of the message that was writen by the user
        **/
        function PostMessage($date,$userID,$projectID,$message)
        {
            try
            {
                $conn = $this->connect();

                $qs = "INSERT INTO Message(date,content,fkUser,fkProject) VALUES (:date,:content,:userID,:projectID)";

                $query = $conn->prepare($qs);

                $query->bindParam(":date",$date);
                $query->bindParam(":content",$message);
                $query->bindParam(":userID",$userID);
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
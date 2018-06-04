<?php

    require_once "Controller.php";

    /**
     * @brief Handles Control over the forum
    **/
    class ForumController extends Controller
    {


        /**
         * @brief basic constructor
        **/
        function __construct()
        {
            
        }

        /**
         * @brief initialises the data access objects
        **/
        function Init($dao,$userDAO,$projectDAO,$versionDAO,$forumDAO)
        {
            $this->baseDAO = $dao;
            $this->userDAO = $userDAO;
            $this->projectDAO = $projectDAO;
            $this->versionDAO = $versionDAO;
            $this->forumDAO = $forumDAO;
        }
        /**
         * ViewForums
         *
         * @brief Displays a list of all the topics/project
         */
        function ViewForums($limit)
        {
            $forumData = $this->forumDAO->GetAllTopics($limit);

            require_once "View/AllForumView.php";
        }

        /**
         * @brief displays all the message concerning a project
         *
         * @param [int] $projectID the ID of the project from wich the messages will be displayed
        **/
        function DisplayMessage($projectID)
        {
            $topicData = $this->forumDAO->GetProjectMessage($projectID);
            $author = $this->projectDAO->GetProjectAuthor($projectID);
            $projectName =  $this->projectDAO->GetProjectName($projectID);

            $error = $this->forumDAO->error;

            require_once "View/TopicView.php";
        }

        /**
         * @brief Write a message on a specific topic
         *
         * @param [date] $date date and time when the message was posted
         * @param [string] $userName wich user posted the message
         * @param [int] $projectID id from the project on wich the user writes
         * @param [string] $message content of the message that the user wrote
        **/
        function PostMessage($date,$userName,$projectID,$message)
        {
            $userID = $this->userDAO->GetIDByUserName($userName);

            $this->forumDAO->PostMessage($date,$userID,$projectID,$message);
            $this->DisplayMessage($projectID);
        }
    }
?>
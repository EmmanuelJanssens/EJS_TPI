<?php

    require_once "Controller.php";
    class ForumController extends Controller
    {


        function __construct()
        {
            
        }

        function Init($dao,$userDAO,$projectDAO,$versionDAO,$forumDAO,$MessageDAO)
        {
            $this->baseDAO = $dao;
            $this->userDAO = $userDAO;
            $this->projectDAO = $projectDAO;
            $this->versionDAO = $versionDAO;
            $this->forumDAO = $forumDAO;
            $this->messageDAO = $MessageDAO;
        }
        /**
         * ViewForums
         *
         * @brief Displays a list of all the topics/project
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        function ViewForums()
        {
            $forumData = $this->forumDAO->GetAllTopics();

            require_once "View/AllForumView.php";
        }

        function DisplayMessage($action,$projectID,$project)
        {
            $topicData = $this->forumDAO->GetProjectMessage($projectID);
            $author = $this->projectDAO->GetProjectAuthor($projectID);
            $projectName = $project;
            require_once "View/TopicView.php";
        }
    }
?>
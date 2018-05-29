<?php

    require_once "Controller.php";
    class ForumController extends Controller
    {


        function __construct()
        {
            
        }

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
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        function ViewForums()
        {
            $forumData = $this->forumDAO->GetAllTopics();

            require_once "View/AllForumView.php";
        }

        function DisplayMessage($projectID)
        {
            $topicData = $this->forumDAO->GetProjectMessage($projectID);
            $author = $this->projectDAO->GetProjectAuthor($projectID);
            $projectName =  $this->projectDAO->GetProjectName($projectID);

            $error = $this->forumDAO->error;

            require_once "View/TopicView.php";
        }

        function PostMessage($date,$userName,$projectID,$message)
        {
            $userID = $this->userDAO->GetIDByUserName($userName);

            $this->forumDAO->PostMessage($date,$userID,$projectID,$message);
            $this->DisplayMessage($projectID);
        }
    }
?>
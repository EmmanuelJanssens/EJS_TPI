<?php
    /**
     * Controller
     *
     * @brief Handles the interactions with the views Base class will manage navigation in the main pages of the website
     */
    class Controller
    {

        public $baseDAO;

        public $userDAO;
        public $projectDAO;
        public $versionDAO;
        public $forumDAO;



        /**
         * @brief Initialises every data access Object
         *
         * @param [DAO] $dao basic data access
         * @param [userDAO] $userDAO
         * @param [projectDAO] $projectDAO
         * @param [versionDAO] $versionDAO
         * @param [forumDAO] $forumDAO
         */
        function Init($dao,$userDAO,$projectDAO,$versionDAO,$forumDAO)
        {
            $this->baseDAO = $dao;
            $this->userDAO = $userDAO;
            $this->projectDAO = $projectDAO;
            $this->versionDAO = $versionDAO;
            $this->forumDAO = $forumDAO;
        }

        /**
         * @brief Initialises base data object.
         * @param [DAO] $dao basic data access
         * @param [userDAO] $useDAO access the user's data
         * @param [versionDAO] $versionDAO access the version's dat
         * @param [forumDAO] $forumDAO acces the forum's data
         */
        function __construct($dao,$userDAO,$projectDAO,$versionDAO,$forumDAO)
        {
            $this->baseDAO = $dao;
            $this->userDAO = $userDAO;
            $this->projectDAO = $projectDAO;
            $this->versionDAO = $versionDAO;
            $this->forumDAO = $forumDAO;
        }


        /**
         * ViewHome
         *
         * @brief Display the home page.
         */
        function ViewHome($limit)
        {
            $projectData = $this->projectDAO->GetAllProject($limit);

            $error = $this->projectDAO->error;
            require_once "View/HomeView.php";
        }





        /**
         * ViewAbout
         *
         * @brief Displays the about page from the website

         */
        function ViewAbout()
        {
            require_once "View/AboutView.php";
        }
    }
?>
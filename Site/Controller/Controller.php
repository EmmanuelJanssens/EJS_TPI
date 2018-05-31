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
         * @param [type] $userDAO
         * @param [type] $projectDAO
         * @param [type] $versionDAO
         * @param [type] $forumDAO
         *
         * @brief Initialises every data access Object
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
         * @param [type] $dao
         * @brief Initialises base data object.
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
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
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
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        function ViewAbout()
        {
            require_once "View/AboutView.php";
        }
    }
?>
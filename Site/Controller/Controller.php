<?php
    /**
     * Controller
     *
     * @brief Handles the interactions with the views Base class will manage navigation in the main pages of the website
     */
    class Controller
    {

        /**
         * ViewHome
         *
         * @brief Display the home page.
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        function ViewHome()
        {
            require_once "View/HomeView.php";
        }

        /**
         * ViewProject
         *
         * @brief Displays a list of all the project
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        function ViewProjects()
        {
            require_once "View/AllProjectView.php";
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
            require_once "View/AllForumView.php";
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
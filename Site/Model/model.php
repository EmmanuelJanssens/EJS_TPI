<?php
/**
 * @author emmanuel <emmanueljanssens72@gmail.com>
 * @todo Something
 * @see http://url.com
 */
    class Model
    {
        /**
         * @brief Title of the current page
         * 
         */
        public $Title;

        /**
         * @brief View that will be used
         *
         * @todo something
         */
        public $view;        

        /**
         * Initialyzes the base parameters of the class
         *
         * @param [type] $view
         */
        public function __construct($view)
        {
            $this->view = $view;
            $this->Title = "EPM";
            
        }
        
        /**
         * Undocumented function
         *
         * @brief Some brief description.
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
         */
        public function open_db_connection()
        {

        }

        /**
         * Close the database connection
         *
         * @return void
         */
        public function close_db_connection()
        {

        }

        public function set_recettes()
        {
            //get data and update view page
            $this->view->display_recettes();
        }
        public function set_photos()
        {
            $this->view->display_photos();
        }
        public function set_films()
        {
            $this->view->display_films();
        }
        public function set_doc()
        {
            $this->view->display_doc();
        }
    }
?>
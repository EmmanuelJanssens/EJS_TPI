<?php
    class View
    {
        public function default_page()
        {
            $content = 
<<<HTML
            <h1>
                Default Page
            </h1>
HTML;
            require_once("template.php");
        }

        public function display_recettes()
        {
            $content =
<<<HTML
            <h1>
                <i>
                    List of recettes
                </i>
            </h1>
HTML;
            require_once("template.php");
        }
        public function display_photos()
        {
            $content =
<<<HTML
            <h1>
                List of photos
            </h1>
HTML;
            require_once("template.php");

        }
        public function display_films()
        {
            $content =
<<<HTML
            <h1>
                List of films
            </h1>
HTML;
            require_once("template.php");

        }

        public function display_doc()
        {
            $content =
<<<HTML
            <h1>
                List of Doc
            </h1>
HTML;
            require_once("template.php");

        }

    }
?>
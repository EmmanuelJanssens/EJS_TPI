<?php
    class Controller
    {
        private $model;
        private $view;

        public function __construct($model,$view)
        {
            $this->model = $model;
            $this->view = $view;
        }

        public function clicked()
        {
            $this->model->Title = "Clickkkk";
        }


        public function rechercher_recettes()
        {
            $this->model->Title = "Recette ";
            
            $this->model->set_recettes();
        }
        public function rechercher_photo()
        {
            $this->model->Title = "Photo";

            $this->model->set_photos();
        }
        public function afficher_film()
        {
            $this->model->Title = "Film";

            $this->model->set_films();
        }
        public function rechercher_doc_enseignant()
        {
            $this->model->Title = "Doc";

            $this->model->set_doc();
        }

    }
?>
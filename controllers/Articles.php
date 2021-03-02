<?php
class Articles extends Controller {
    /**
         * Cette méthode affiche la liste des articles
         * 
         * @return void
         */
    public function index(){
        //On instancie le modèle "Article"
        $this->loadModel('Article');

        //On stocke la liste des articles dans $articles
        $articles = $this->Article->getAll();

        //On envoie les données à la vue index
        $this->render('index', compact('articles'));
    }
}
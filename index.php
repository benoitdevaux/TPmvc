<?php
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');

//On sépare les paramètres et on les met dans le tableau $params
$params = explode('/', $_GET['p']);

//Si au moins 1 paramètre existe
if($params[0] != "") {
    //On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
    $controller = ucfirst($params[0]);
    
    //On sauvegarde le 2ème paramètre dans $action s'il existe, sinon $action prend la valeur index
    $action = isset($params[1]) ? $params[1] : 'index';
    
    //On appelle le contrôleur
    require_once(ROOT.'controllers/'.$controller.'.php');
    
    //On instancie le contrôleur
    $controller = new $controller();
    
    if(method_exists($controller, $action)) {
        //On appelle la méthode $action du controller $controller
        call_user_func_array([$controller, $action], $params);  
    } else {
        //Renvoie le code d'erreur 404
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    //On appelle le contrôleur par défaut
    require_once(ROOT.'controllers/Main.php');

    //On instancie le contrôleur 
    $controller = new Main();

    //On appelle la méthode index
    $controller->index();
}
?>
<?php
// Débute ou récupère une session
//-------------------------------
session_start();
//-------------------------------

// Vérifier la présence du fichier .htaccess à la racine du site.

// if (file_exists('.htaccess')) {
//     // Le fichier .htaccess existe
//     error_log("Le fichier .htaccess est présent à la racine du site.", LOG_INFO);
// } else {
//     // Le fichier .htaccess n'éxiste pas
//     $error_message = "Le fichier .htaccess est manquant à la racine du site à la ligne " .
//         __LINE__ . ". Timestamp : " . date('Y-m-d H:i:s');
//     error_log($error_message, LOG_ERR);
// }

// Class autoloader
function loadClass($class)
{
    if (strpos($class, 'Controller') !== false) {
        require 'controllers/' . $class . '.php';
    }
    if (strpos($class, 'Model') !== false) {
        require 'models/' . $class . '.php';
    }
}

spl_autoload_register('loadClass');

//error_log(print_r($_GET, 1));

// Racine du site ( C:/wamp/www/chatmvc/ )
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

// On sépare les paramètres et on les met dans le tableau $params
$params = explode('/', $_GET['action']);


// Si au moins 1 paramètre existe
if (isset($params[1])) {
    // On sauvegarde le 1er paramètre dans $controller
    // puis, on lui en ajoute le suffixe Controller.
    $controller = $params[0] . "Controller";

    // On sauvegarde le 2ème paramètre dans $method si il existe, sinon index
    $method = $params[1];

    // On sauvegarde le 3ème paramètre dans $roomId si il existe, sinon 1
    $roomId = isset($params[2]) ? $params[2] : 1;

    // On appelle le controller correspondant
    error_log(ROOT . 'controllers/' . $controller . '.php');
    // On instancie la classe correspondante
    $oController = new $controller();

    // On vérifie si la méthode existe bien dans la classe
    if (method_exists($oController, $method)) {
        // On appelle la méthode $method du controleur $controller
        $oController->$method($roomId);// Envoie de roomid a chatIndex si appelé
    } else {
        // On envoie le code réponse 404
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    // Ici aucun paramètre n'est défini
    // On appelle le contrôleur par défaut : loginController

    // On instancie le contrôleur
    $oController = new loginController();

    // On appelle la méthode login
    $oController->loginIndex();
}

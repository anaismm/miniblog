<?php

session_start();
require("controllers/auto_loger.php");

$requeteBrute = $_SERVER['REQUEST_URI'];

$webroot = dirname($_SERVER['PHP_SELF']); // DETERMINE LA RACINE DE NOTRE SITE QUI EST /BLOG

$requete = ($webroot !== '/') ? substr($requeteBrute, strlen($webroot)) : $requeteBrute;

$requete = strtok($requete, '?');

$requeteDecomposee = explode('/', $requete);

$controlleurDemande = $requeteDecomposee[1];

function dbConnect(){
    $db=new PDO('mysql:host=localhost;dbname=blog;port=3306;charset=utf8', 'root', '');
    return $db;
}

$prefixeUrl = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}$webroot/";


switch ($controlleurDemande) {
    case '':
        require 'controllers/accueil.php';
        break;

    case 'signup';
        require 'controllers/login.php';
        break;

    case 'login':
        require 'controllers/login.php';
        break;

    case 'logout';
        require 'controllers/login.php';
        break;

    case 'create';
        require 'controllers/editor.php';
        break;

    case 'delete';
        require 'controllers/editor.php';
        break; 
    
    case 'post';
        require 'controllers/post.php';
        break;
    
    case 'archives';
        require 'controllers/post.php';
        break;

    case 'about';
        require 'controllers/about.php';
        break;

    default:
        require 'controllers/errors.php';
}
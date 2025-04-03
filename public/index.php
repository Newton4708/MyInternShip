<?php
// public/index.php

// 1. Démarrage de la session pour gérer les données utilisateur
session_start();

// 2. Chargement de la configuration globale
require_once __DIR__ . '/../config/config.php';
// 2.1 Définition de la constante BASE_URL pour faciliter la gestion des URLs
define('BASE_URL', str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME'])));

// 3. Chargement de l'autoloader Composer (s'il est utilisé)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// 4. Chargement des classes essentielles (par exemple, le routeur)
require_once __DIR__ . '/../core/Router.php';

// 5. Chargement du fichier de routes (tableau associatif définissant les correspondances URL -> Controller/Action)
$routes = require_once __DIR__ . '/../config/routes.php';

// 6. Instanciation du routeur en lui passant les routes définies
$router = new Router($routes);

// 7. Traitement de la requête et redirection vers le contrôleur/action approprié
try {
    $router->dispatch();
} catch (Exception $e) {
    // Gestion des erreurs (affichage d'une page d'erreur ou redirection)
    // Vous pouvez par exemple inclure une vue d'erreur personnalisée :
    http_response_code(500);
    echo 'Une erreur est survenue : ' . $e->getMessage();
}

































// // public/index.php
// session_start();

// // Charge les configurations et l'autoload (si vous n'utilisez pas Composer, sinon utilisez vendor/autoload.php)
// require_once __DIR__ . '/../config/config.php';
// require_once __DIR__ . '/../vendor/autoload.php'; // si nécessaire
// require_once __DIR__ . '/../core/Router.php';

// // Si vous utilisez un fichier de routes, vous pouvez le charger ici (optionnel)
// $routes = require_once __DIR__ . '/../config/routes.php';

// // Dispatcher la requête
// $router = new Router();
// $router->dispatch();


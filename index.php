<?php
/**
 * Routeur principal - Point d'entrée unique
 */
session_start();

// Load environment variables (optional .env)
require_once __DIR__ . '/core/Env.php';
try {
    Env::load(__DIR__ . '/.env');
} catch (Exception $e) {
    // .env missing or unreadable — continue with defaults
}

// Configuration: control error display from APP_DEBUG
$debug = Env::get('APP_DEBUG', 'false');
if (in_array(strtolower($debug), ['1', 'true', 'on'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Autoloader
spl_autoload_register(function ($class) {
    $paths = [
        'controllers/' . $class . '.php',
        'models/' . $class . '.php',
        'core/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
    }
    return false;
});

// Chargement des fichiers de configuration
require_once 'config/database.php';

// Routage
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$urlParts = explode('/', $url);

// Déterminer le contrôleur
$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'HomeController';
$method = isset($urlParts[1]) ? $urlParts[1] : 'index';
$params = array_slice($urlParts, 2);

// Vérifier si le contrôleur existe
if (file_exists('controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        header("HTTP/1.0 404 Not Found");
        include 'views/errors/404.php';
    }
} else {
    header("HTTP/1.0 404 Not Found");
    include 'views/errors/404.php';
}
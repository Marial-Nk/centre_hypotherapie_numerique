<?php

use Illuminate\Http\Request;

if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

// Vérifier si l'application est en mode maintenance
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Charger l'autoloader de Composer
require __DIR__.'/../vendor/autoload.php';

// Charger l'application Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Capturer la requête HTTP entrante
$request = Request::capture();

// Traiter la requête avec Laravel
$response = $app->handle($request);

// Envoyer la réponse au client
$response->send();

// Terminer proprement l'exécution de l'application
$app->terminate($request, $response);

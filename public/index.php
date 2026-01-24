<?php
// ---------------------------------
// Front Controller / index.php
// ---------------------------------

// Show all errors during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Load Composer autoload
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// ---------------------------------
// Load routes
// ---------------------------------
$routesFile = __DIR__ . '/../routes/routes.php';
if (!file_exists($routesFile)) {
    die("Routes file missing: $routesFile");
}
$routes = require $routesFile;

// ---------------------------------
// Determine request URI
// ---------------------------------
$basePath = '/yip_online/public'; // adjust if in a subfolder
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove base path from URI
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
$uri = rtrim($uri, '/') ?: '/';

// ---------------------------------
// Match route
// ---------------------------------
$found = false;
foreach ($routes as $group => $groupRoutes) {
    if (!isset($groupRoutes[$uri])) continue;

    [$controller, $method] = $groupRoutes[$uri];

    // Build full class namespace
    $class = "App\\Controllers\\$controller";

    // Check class exists
    if (!class_exists($class)) {
        http_response_code(500);
        exit("Controller $class not found. Check namespace, filename, and Composer autoload.");
    }

    $instance = new $class();

    // Check method exists
    if (!method_exists($instance, $method)) {
        http_response_code(500);
        exit("Method $method not found in controller $class");
    }

    // Call controller method
    $instance->$method();
    $found = true;
    break;
}

// ---------------------------------
// 404 Not Found
// ---------------------------------
if (!$found) {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>The page <strong>$uri</strong> does not exist.</p>";
}

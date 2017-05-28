<?php

error_reporting(E_ALL);

// For development server, turn on displaying errors
ini_set('display_errors', 1);

// For production server, turn off displaying errors, turn logging errors on
//ini_set('display_errors', 0); // Production
//ini_set('log_errors', 1);

$config = parse_ini_file('../app/configs/config.ini');

session_start();

// Setting internal encoding for string functions
mb_internal_encoding("UTF-8");

spl_autoload_register('autoload');
set_error_handler('errorHandler');

// Creating the router and processing parameters from the user's URL
$router = new \Webb\App\Controllers\RouterController();

$router->process(array($_SERVER['REQUEST_URI']),
    new \Webb\App\Models\Db($config['host'], $config['username'],
    $config['password'], $config['database']));

// Rendering the view
$router->renderView();

function autoload($className)
{
    $className = ltrim($className, '\\'); // Removes last \
    $fileName = '';
    $namespace = '';
    $lastNsPos = strrpos($className, '\\');

    if ($lastNsPos > 0) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $namespace)
            . DIRECTORY_SEPARATOR); // lower case directory path
    }

    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require_once '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $fileName;
}

function errorHandler($errno, $errstr, $errfile, $errline)
{
    error_log("[$errno] $errstr in $errfile:$errline");
    header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
    header('Content-Type: application/json');
    //echo json_encode(["error" => 'Server error]); // Production server
    echo json_encode(['errno'   => $errno, 'errstr'  => $errstr, 'errfile' => $errfile,
        'errline' => $errline]); // Development server
    exit;
}

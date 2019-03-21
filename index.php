<?php

use App\Router;

require __DIR__ . '/config/lib.php';
require __DIR__ . '/App/autoload.php';

$controllerName = '\\' .  Router::processRoute( parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) );

if ('GET' === $_SERVER['REQUEST_METHOD']){
    $method = 'GET';
    $requestParams = $_GET;
}elseif ('POST' === $_SERVER['REQUEST_METHOD']){
    $method = 'POST';
    $requestParams = $_POST;
}

//debug($controllerName);
$controller = new $controllerName;

if($controller){
    $controller($method, $requestParams);
}else{
    die('Не найден контроллер');
}

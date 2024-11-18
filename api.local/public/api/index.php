<?php

require_once "../../vendor/autoload.php";

$request = $_SERVER['REQUEST_URI'];
$chunks = explode("/", $request);

// print_r("<pre>");
// print_r($chunks);
// print_r("</pre>");

switch ($chunks[2]) {
    case '':
    case '/':
        // Responder con Unauthorized si no se especifica un endpoint
        http_response_code(401);
        echo '<h1>Unauthorized</h1>';
        die();
        break;

    case 'users':
        // Verificar el método HTTP
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Responder con los usuarios en formato JSON
            echo ApiController::getLinks(ApiController::JSON);
            die();
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lógica para manejar POST (en blanco por ahora)
        }
        break;

    default:
        // Ruta no encontrada
        http_response_code(404);
        echo '<h1>Not found!</h1>';
        die();
}

<?php

// import des middlewares
include 'Models/DatabaseDriver.php';
$dbd = new DatabaseDriver;

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

// check base URL
if ($request[0] != 'api' || $request[1] == null) {
    echo ('error');
    http_response_code(404);
    exit();
}

// on ne supporte que les requetes GET
if ($method != 'GET') {
    echo ('error : only GET supported');
    http_response_code(405);
    exit();
}

// traiter requête
switch ($request[1]) {
    case 'meridiens':
        // routes : /meridiens/all
        if ($request[2] != null && $request[2] == 'all') {
            // $dbd->
        } else {
            echo ('error : not supported');
            http_response_code(400);
            exit();
        }
        break;
    case 'symptomes':
        // routes : /symptomes/all
        //          /symptomes/:keyword
        if ($request[2] != null) {
            if($request[2] == 'all'){

            }else{

            }
        } else {
            echo ('error : not supported');
            http_response_code(400);
            exit();
        }
        break;
    case 'pathologies':
        // routes : /pathologies/all
        if ($request[2] != null && $request[2] == 'all') {
        } else {
            echo ('error : not supported');
            http_response_code(400);
            exit();
        }
        break;

    default:
        echo ('error : ressource not found');
        http_response_code(404);
        exit();
        break;
}

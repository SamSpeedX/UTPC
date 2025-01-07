<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require "App/http/app.php"; 

class Router 
{

    public static function view($url, $file)
    {
        $njia = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $callback = $file;

        if ($njia === $url) {
            $view = "views/{$callback}.sam.php";
    
            if (file_exists($view)) {
                require $view;
            } else {
                echo"No such folder or your file don't have the following extension .sam.php";
            }
        }
    }

    public static function post($url, $controllerClass)
    {
        $controller = $controllerClass[0];
        
        $function = $controllerClass[1];
        $njia = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if ($njia === $url) {
            if ($_SERVER['REQUEST_METHOD'] !=='POST') {
                echo "Invalid method!";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                echo "Invalid method!";
            }
            $request = $_POST;
            
            $controllerFile = "App/Controller/{$controller}.php";

            if (file_exists($controllerFile)) {
                require $controllerFile;

                $action = new $controller();
                $response =  $action->$function($request);

                echo $response['message'];

            } else {
                echo "No such Controller";
            }
        }
    }

    public static function get($url, $controllerClass)
    {
        $controller = $controllerClass[0];
        
        $function = $controllerClass[1];
        $njia = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if ($njia === $url) {
            if ($_SERVER['REQUEST_METHOD'] ==='POST') {
                echo "Invalid method!";
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                echo "Invalid method!";
            }

            // $request = $_GET;
            $controllerFile = "App/Controller/{$controller}.php";

            if (file_exists($controllerFile)) {

                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $request = $_GET;
                    require $controllerFile; 
                    $action = new $controller();
                    $function = $controllerClass[1];
                    $questions = $action->$function($request);
                    $response = $action->$function($request);
                    // require $view;

                    // var_dump($response);
                    echo $response['message'];

                }
            } else {
                echo "No such Controller";
            }
        }
    }

    public static function request($url, $controllerClass, $callback)
    {
        $controller = $controllerClass[0];
        $function = $controllerClass[1];
        $controllerFile = "App/Controller/{$controller}.php";

        $njia = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ;

        if ($njia === $url) {
            $view = "views/{$callback}.sam.php";
    
            if (file_exists($view) === file_exists($view)) {

                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $request = $_GET;
                    require $controllerFile; 
                    $action = new $controller();
                    $function = $controllerClass[1];
                    $questions = $action->$function($request);
                    $response = $action->$function($request);
                    require $view;
                }
                
            } else {
                echo"No such folder or your file don't have the following extension .sam.php";
            }
        }
    }

    public function redirect($direction) {
        header('location: '.$direction);
    }

    public static function api($url, $controller) 
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if ($url == $path) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                header('Content-Type: application/json');
                echo json_encode(['name' => 'post']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                header('Content-Type: application/json');
                echo json_encode(['name' => 'get']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'PATH') {
                header('Content-Type: application/json');
                echo json_encode(['name' => 'path']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                header('Content-Type: application/json');
                echo json_encode(['name' => 'delete']);
            }
        }
    }
}
?>

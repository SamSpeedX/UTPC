<?php
require_once __DIR__.'/vendor/autoload.php';
require 'core/Router.php';

// main
Router::view('', 'welcome');
Router::view('home', 'welcome');
Router::view('about', 'about');
Router::view('updatepassword', 'Auth/updatepass');
Router::view('login', 'Auth/signin');
Router::view('register', 'Auth/signup');
Router::view('sponser', 'sponsor');
Router::post('log_in', [userController::class, 'login']);
Router::post('user_register', [userController::class, 'register']);
Router::post('change', [userController::class, 'update']);
Router::get('logout', [userController::class, 'logout']);

// profile
Router::request('profile', [userController::class, 'readone'], 'Auth/user_dash');

Router::request('updateuser', [userController::class, 'readone'], 'Auth/update');

// admin
Router::request('boss', [userController::class, 'readone'], 'Admin/user_dash');

Router::view('addquestion', 'Admin/question');

Router::view('apply', 'apply');


// api
Router::api('name', 'userController');
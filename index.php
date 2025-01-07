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
Router::get('deleteuser', [UserController::class, 'delete']);
Router::get('logout', [userController::class, 'logout']);

// profile
Router::request('profile', [userController::class, 'readone'], 'Auth/user_dash');

Router::request('updateuser', [userController::class, 'readone'], 'Auth/update');

// admin
Router::view('in', 'Admin/signin');
Router::view('samtechnology','Admin/signup');
Router::request('dashboard', [bossController::class, 'readone'], 'Admin/user_dash');

Router::post('ingia', [bossController::class, 'login']);
Router::post('sajili', [bossController::class, 'register']);
Router::post('badili', [bossController::class, 'update']);
Router::get('fukuzaboss', [bossController::class, 'delete']);
Router::get('logout', [bossController::class, 'logout']);

// Router::get('preview', []);
Router::get('delapplication', [myaplicationController::class, 'delete']);

Router::request('updateboss', [bossController::class, 'readone'], 'Admin/update');

Router::view('addquestion', 'Admin/question');

// Router::get('apply', [myaplicationController::class, 'index']);
Router::request('apply', [myaplicationController::class, 'index'], 'apply');
Router::request('userapplication', [bossController::class, 'application'], 'Admin/aplication');
Router::request('application', [applicationController::class, 'readall'], 'Admin/aplicationlist');

// api
Router::api('name', 'userController');
<?php
require "App/Model/user.php";

class UserController
{
    // 
    public function index()
    {
        // 
    }

    public function readone($session_id)
    {
        $user = new User();
        $result = $user->user($session_id);
        return $result;
    }

    public function users()
    {
        $user = new User();
        $users = $user->readAll();
        return $users;
    }

    public function login($request)
    {
        $user = new User();

        $email = $request['email'];
        $password = $request["password"];

        $result = $user->login($email, $password);

        if ($result['status'] == 'success') {
            // process your session
            $_SESSION['token'] = $result['session_id'];
            return Redirect::to('home');

        } else {
            // error message.
            return ['message' => $result['message']];
        }
    }

    public function register($request)
    {
        $user = new User();

        $name = $request['username'];
        $email = $request['email'];
        $password = $request['password'];

        $result = $user->register($name, $email, $password);

        if ($result['status'] == 'success') {
            Redirect::to('login');
        }
       
        return ['message' => $result['message']];

    }

    public function update($request)
    {
        $id = $request['token'];
        $name = $request['username'];
        $email = $request['email'];
        $result = user::update($id, $name, $email);

        if ($result['status'] == 'success') {
            Redirect::to('dashboard');
        }
    }

    public function delete($data)
    {
        $user = new User();

        $token = $data['token'];
        $response = $user->delete($token);

        if ($response['status'] == 'success') {
            Redirect::to('logout');
        } 
    }

    public function logout()
    {
        session_destroy();
        session_abort();

        Redirect::to('home');
    }
}

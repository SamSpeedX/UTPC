
<?php
// php framework by SAM TECHNOLOGY.
// customise as you wish

require "App/Model/boss.php";

class bossController
{
    // 
    public function index()
    {
        // 
    }

    public function application()
    {
        $app = new boss();
        $response = $app->applications();
        return $response;
    }

    public function readone($session_id)
    {
        $user = new boss();
        $result = $user->user($session_id);
        return $result;
    }

    public function users()
    {
        $user = new boss();
        $users = $user->readAll();
        return $users;
    }

    public function login($request)
    {
        $user = new boss();

        $email = $request['email'];
        $password = $request["password"];

        $result = $user->login($email, $password);

        if ($result['status'] == 'success') {
            // process your session
            $_SESSION['uid_boss'] = $result['session_id'];
            return Redirect::to('dashboard');

        } else {
            // error message.
            return ['message' => $result['message']];
        }
    }

    public function register($request)
    {
        $user = new boss();

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
        $boss = new boss();
        $id = $request['token'];
        $name = $request['username'];
        $email = $request['email'];
        $result = $boss->update($id, $name, $email);

        if ($result['status'] == 'success') {
            return Redirect::to('dashboard');
        }
    }

    public function delete($data)
    {
        $boss = new boss();

        $token = $data['token'];
        $response = $boss->delete($token);

        if ($response['status'] == 'success') {
            return Redirect::to('logout');
        } 
    }

    public function logout()
    {
        session_destroy();
        session_abort();

        return Redirect::to('home');
    }
}

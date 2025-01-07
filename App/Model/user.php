<?php


class User 
{
    private $table;

    public function __construct() {

        $f = dirname(__FILE__);
        $p = strrpos($f, '.');
        $t = substr($f, 0, $p);
        // 
        $this->table = "users";
    }

    public function time() {
        return date('H:i:s');
    }

    public function user($user_id)
    {
        $sam = new Database();
        $kibalanga = $sam->connect();
        $Eshod = new Security();

        $sql = "SELECT * FROM `{$this->table}` WHERE token=:ui";
        $stmt = $kibalanga->prepare($sql);
        $stmt->bindParam(":ui", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function readAll() {
        $sam = new Database();
        $kibalanga = $sam->connect();

        $query = "SELECT * FROM {$this->table}";
        $stmt = $kibalanga->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function login($email, $password)
    {
        $conn = new Database();
        $sam = $conn->connect();

        $eshod = new Security();

        $email1 = $eshod->guard($email);
        $password1 = $eshod->guard($password);
        $time = $this->time();

        $query = "SELECT * FROM `{$this->table}` WHERE email=:email";
        $stmt = $sam->prepare($query);
        $stmt->bindParam(":email", $email1, PDO::PARAM_STR);
        $stmt->execute();
        $mtu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1) {
            
            if ($mtu && password_verify($password1, $mtu['password'])) {

                if ($stmt->execute()) {
                    $sss1 = $stmt->fetch(PDO::FETCH_ASSOC);
                    return [
                        'status' => 'success',
                        'session_id' => $mtu['token'],
                    ];
                } else {
                    return [
                        'status' => 'fail',
                        'message' => 'error'.$stmt->execute()
                    ];
                }
                
            } else {
                return ['status' => 'warning', 'message' => "Incorrect password"];
            }
            
        } else {
            return ['status' => 'warning', 'message' => "Incorrect email"];
        }

    }

    public function register($name, $email, $password) {
        $sam = new Database();
        $kibalanga = $sam->connect();
        $eshod = new Security();

        $jina = $eshod->guard($name);
        $pepe = $eshod->guard($email);
        $pass = $eshod->guard($password);
        $msimbo = password_hash($pass, PASSWORD_DEFAULT);

        $sql = 'CREATE TABLE IF NOT EXISTS users (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
       );';

       $sql = "CREATE TABLE IF NOT EXISTS users ( `id` int(11) NOT NULL AUTO_INCREMENT, `username` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL, `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id) );";

       $kibalanga->exec($sql);
       $stmt = $kibalanga->prepare($sql);

        $query = "SELECT * FROM `{$this->table}` WHERE email=:email";
        $stmt = $kibalanga->prepare($query);
        $stmt->bindParam(":email", $pepe, PDO::PARAM_STR);
        $stmt->execute();
        $mtu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() !== 1) {
            $token = uniqid();

            $query = "INSERT INTO {$this->table} SET username=:name, email=:email, password=:password, token=:token";
            $stmt = $kibalanga->prepare($query);
            $stmt->bindParam(":name", $jina, PDO::PARAM_STR);
            $stmt->bindParam(":email", $pepe, PDO::PARAM_STR);
            $stmt->bindParam(":password", $msimbo, PDO::PARAM_STR);
            $stmt->bindParam(":token", $token, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return [
                    'status' => 'success',
                    'message' => 'Register success!'
                ];
            } else {
                return [
                    'status' => 'fail',
                    'message' => 'Registration fail!',
                ];
            }
        } else {
            return [
                'status' => 'warning',
                'message' => 'Email was Taken!',
            ];
        }
        
    }

    public static function update($id, $name, $email) 
    {
        $sam  = new Database();
        $kibalanga = $sam->connect();

        $eshod = new Security();

        $jina = $eshod->guard($name);
        $pepe = $eshod->guard($email);
        
        $query = "UPDATE `users` SET username=:uname, email=:email WHERE token=:id";

        $stmt = $kibalanga->prepare($query);
        $stmt->execute([
            'uname' => $jina,
            'email' => $pepe,
            'id' => $id
        ]);

        if ($stmt->rowCount() == 1) {
            return [
                'status' => 'success',
                'message' => 'update successful',
            ];
        } else {
            return [
                'status' => 'fail',
                'message' => 'update fail',
            ];
        }
    }

    public function delete($session_id) {
        $sam = new Database();
        $kibalanga = $sam->connect();
        $eshod = new Security();

        $uid = $eshod->guard($session_id);

       

        $sql = "DELETE FROM `{$this->table}` WHERE token=:id";
        $stmt = $kibalanga->prepare($sql);
        $stmt->bindParam(":id", $uid, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return [
                'status' => 'success',
                'message' => 'Delete successful'
            ];
        } else {
            return [
                'status' => 'fail',
                'message' => 'Delete fail'
            ];
        }
    }

}
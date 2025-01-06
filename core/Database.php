<?php

class Database
{
    private $host;
    private $db_name;
    private $dbuser;
    private $dbpass;

    public function __construct() {
        $this->host = DB_HOST;
        $this->db_name = DB_NAME;
        $this->dbuser = DB_USER;
        $this->dbpass = DB_PASSWORD;
    }

    public function connect()
    {   
        if (DATABASE == 'mysql') {
            try {
                $kibalanga = new PDO("mysql:host = {$this->host}; dbname={$this->db_name}; charset=utf8mb4", $this->dbuser, $this->dbpass);
    
                $kibalanga->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "CREATE TABLE IF NOT EXISTS users ( `id` int(11) NOT NULL AUTO_INCREMENT, `username` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL, `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id) );";

                $sql = 'CREATE TABLE IF NOT EXISTS users (
                     `id` int(11) NOT NULL AUTO_INCREMENT,
                     `username` VARCHAR(255) NOT NULL,
                     `email` VARCHAR(255) NOT NULL,
                     `password` VARCHAR(255) NOT NULL,
                     `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                     PRIMARY KEY (id)
                );';

                $kibalanga->exec($sql);

                return $kibalanga;
            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
                return null;
            }
        }

        if (DATABASE == 'sqlite') {
            try {
                $kibalanga = new PDO("sqlite:databases/databse.sqlite");
                $kibalanga->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $kibalanga;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }

    public function mysql()
    {
        try {
            $mysql = new PDO("mysql:host = {$this->host}; dbname={$this->db_name}; charset=utf8mb4", $this->dbuser, $this->dbpass);

            $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $mysql;
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
            return null;
        }        
    }

    public function sqlite() 
    {
        try {
            $sql = new PDO("sqlite:databases/databse.sqlite");
            $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $sql;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
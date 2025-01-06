<?php

class Env
{
    
    public static function load($file)
    {
        if (! file_exists($file)) {
            echo "env file not found!";
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

Env::load('.env');
define('APP_NAME', $_ENV['APP_NAME']);
define('APP_KEY', $_ENV['APP_KEY']);
define('DEV', $_ENV['DEV']);

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DATABASE', $_ENV['DATABASE']);
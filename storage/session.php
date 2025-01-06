<?php

class Session
{
    public static function check()
    {
        if (! isset($_SESSION['token'])) {
            return Redirect::to('login');
        }
    }
}
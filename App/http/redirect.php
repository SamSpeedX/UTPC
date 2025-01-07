<?php

class Redirect 
{
    public static function to($view)
    {
        header('location: '.$view);
    }

    public static function into($view)
    {
        require "views/{$view}.sam.php";
    }
}
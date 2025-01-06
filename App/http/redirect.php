<?php

class Redirect 
{
    public static function to($view)
    {
        header('location: '.$view);
    }
}
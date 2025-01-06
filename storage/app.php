<?php

class App 
{
    public static function ckeckkey()
    {
        // if (strlen(APP_KEY) == 15) {
        //     return Redirect::to('key');
        // }

        if (empty(APP_KEY)) {
            return Redirect::to('key');
        }
    }
}

App::ckeckkey();
// $elda = $sam->ckeckkey();
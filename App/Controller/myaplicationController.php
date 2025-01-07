
<?php
// php framework by SAM TECHNOLOGY.
// customise as you wish
require 'App/Model/myaplication.php';

class myaplicationController 
{ 
    //  
    public function index($request) 
    { 
        $sam = new myaplication();

        $token = $request['token'];
        if (empty($token)) {
            Redirect::to('home');
        }
        $response = $sam->index($token);

        if ($response['status'] == 'success') {
            $questions = $response['data'];

            if (!$questions) {
                return ['message' => 'Error'];
            }

            // Redirect::into('apply');
            $questions = $response['data'];
            return $questions;
            // Router::view('');
        } else {
        return $response['message'];
        }

    } 

    public function readone($session_id) 
    { 
        $myaplication = new myaplication(); 

        $result = $myaplication->readone($session_id);
 
        if ($result["status"] == "fail") { 
            return $result["message"]; 
        } 

        $question = $result;
        Redirect::into('apply');
        // user info 
        return $result; 
         
    } 

    public function readAll() 
    { 
        $myaplication = new myaplication(); 

        $users = $myaplication->readAll(); 

        //  
        return $users; 

    } 


    public function create($request) 
    { 
        $myaplication = new myaplication();

        $name = $request["name"]; 
        $description = $request["description"]; 
        $extra = $request["extra"]; 

        $result = $myaplication->create($name, $description, $extra); 

        if ($result["status"] == "success") {
           Redirect::to("home"); // path of your destine
        }
    }

    public function update($request) 
    {
        $myaplication = new myaplication();

        $item1 = $request["item1"];
        $item2 = $request["item2"];
        $item3 = $request["item3"];
        $sam = "";

        $result = $myaplication->update($item1, $item2, $item3, $sam);

        if ($result["status"] == "success") {
           Redirect::to("home"); // path of your destine
        }
        return $result["message"];
    }
    
    public function delete($request)
    {
        $myaplication = new myaplication();

        $delete = $request["token"];

        $result = $myaplication->delete($delete);

        if ($result["status"] == "success") {
           return Redirect::to('aplication');
        }
        return $result["message"];
    }
}

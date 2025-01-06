
<?php
// php framework by SAM TECHNOLOGY.
// customise as you wish

require "App/Model/question.php";


class questionController 
{ 
    //  
    public function index() 
    { 
        //  
    } 

    public function readone($session_id) 
    { 
        $question = new question(); 

        $result = $question->readone($session_id);
 
        if ($result["status"] == "fail") { 
            return $result["message"]; 
        } 
 
        // user info 
        return $result; 
         
    } 

    public function readAll() 
    { 
        $question = new question(); 

        $users = $question->readAll(); 

        //  
        return $users; 

    } 


    public function create($request) 
    { 
        $question = new question();

        $name = $request["name"]; 
        $description = $request["description"]; 
        $extra = $request["extra"]; 

        $result = $question->create($name, $description, $extra); 

        if ($result["status"] == "success") {
           Redirect::to("home"); // path of your destine
        }
    }

    public function update($request) 
    {
        $question = new question();

        $id = $request["item1"];
        $name = $request["item2"];
        $description = $request["item3"];
        $extra = "";

        $result = $question->update($id, $name, $description, $extra);

        if ($result["status"] == "success") {
           Redirect::to("home"); // path of your destine
        }
        return $result["message"];
    }
    
    public function delete($request)
    {
        $question = new question();

        $delete = $request["id"];

        $result = $question->delete($delete);

        if ($result["status"] == "success") {
           return $request["message"];
        }
        return $result["message"];
    }
}

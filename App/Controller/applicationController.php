
<?php
// php framework by SAM TECHNOLOGY.
// customise as you wish

require "App/Model/application.php";


class applicationController 
{ 
    //  
    public function index() 
    { 
        //  
    } 

    public function readone($session_id) 
    { 
        $application = new application(); 

        $result = $application->readone($session_id);
 
        if ($result["status"] == "fail") { 
            return $result["message"]; 
        } 
 
        // user info 
        return $result; 
         
    } 

    public function readall() 
    { 
        $application = new application(); 
        $users = $application->readAll(); 
        
        if ($users['status'] == 'success') {
            return $users['data'];
        }
        return $users['message'];

    } 


    public function create($request) 
    { 
        $application = new application();

        $name = $request["name"]; 
        $description = $request["description"]; 
        $extra = $request["extra"]; 

        $result = $application->create($name, $description, $extra); 

        if ($result["status"] == "success") {
           Redirect::to("home"); // path of your destine
        }
    }

    public function update($request) 
    {
        $application = new application();

        $item1 = $request["item1"];
        $item2 = $request["item2"];
        $item3 = $request["item3"];
        $iterm4 = $request["item3"];

        $result = $application->update($item1, $item2, $item3, $iterm4);

        if ($result["status"] == "success") {
           Redirect::to("home"); // path of your destine
        }
        return $result["message"];
    }
    
    public function delete($request)
    {
        $application = new application();

        $delete = $request["id"];

        $result = $application->delete($delete);

        if ($result["status"] == "success") {
           return $request["message"];
        }
        return $result["message"];
    }
}

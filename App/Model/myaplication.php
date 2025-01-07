<?php
// php framework by SAM TECHNOLOGY
// Edit as you wish according to Documentation

class myaplication
{
   public function index($token)
   {
      $sam = new Database();
      $kibalanga = $sam->connect();

      try {
         $sql = "SELECT * FROM `questionnaires` WHERE token=:token";
         $stmt = $kibalanga->prepare($sql);
         $stmt->bindParam(":token", $token, PDO::PARAM_INT);
         $stmt->execute();

         if ($stmt->rowCount() !== 0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['status' => 'success', 'data' =>  $result];
         }
         return ['status' => 'fail', 'message' => 'Invalid token'];

      } catch (PDOException $e) {
         return ['status' => 'fail', 'message' => 'Error: '. $e->getMessage()];
      }
   }

    public function readone($id) 
    {
       $sam = new Database();
       $kibalanga = $sam->connect();

       try {

           $sql = "SELECT * FROM `myaplications` WHERE uid=:id";
           $stmt = $kibalanga->prepare($sql);
           $stmt->bindParam(":id", $id, PDO::PARAM_INT);

           if ($stmt->execute()) {
              $data = $stmt->fetch(PDO::FETCH_ASSOC);
              
              if (empty($data)) {
                 return "No data found!";
              }

              return $data;
           }
           
        } catch (PDOException $e){
           return "Error: " . $e->getMessage();
        }
    }

    public function readall()
    {
       $sam = new Database();
       $kibalanga = $sam->connect();

       try {
           $sql = "SELECT * FROM `myaplications` ";
           $stmt = $kibalanga->prepare($sql);

           if ($stmt->execute()) {
              $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
              if (empty($data)) {
                return "No data found!";
              }
              return $data;
           }
           
        } catch (PDOException $e){
           return "Error: " . $e->getMessage();
        }
    }

    public function create($name, $description, $extra) 
    {
        $sam = new Database();
        $kibalanga = $sam->connect();

        try {
            $sql = "INSERT INTO `myaplications` SET name=:name, description=:description, extra=:extra";
            $stmt = $kibalanga->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":extra", $extra, PDO::PARAM_STR);

            if ($stmt->execute()) {
               return [
                  "status" => "success",
                  "message" => "create successful!"
               ];
            } else {
               return [
                  "message" => "Error: ".$stmt->execute()
               ];
            }

        } catch(PDOException $e) {
            return "Error: ".$e->getMessage();
        }
    }

    public function update($id, $name, $description, $extra)
    {
      $sam = new Database();
      $kibalanga = $sam->connect();

      try {
         $sql = "UPDATE `myaplications` SET name=:name, description=:description, extra=:extra WHERE id=:id";
         $stmt = $kibalanga->prepare($sql);
         $stmt->bindParam(":name", $name, PDO::PARAM_STR);
         $stmt->bindParam(":descrption", $description, PDO::PARAM_STR);
         $stmt->bindParam(":extra", $extra, PDO::PARAM_STR);
         $stmt->bindParam(":id", $id, PDO::PARAM_INT);

         if ($stmt->execute()) {
            return [
               "status" => "success",
               "message" => "update successful!"
            ];
         } else {
            return ["message" => "upadte fail!"];
         }

      } catch (PDOException $e) {
         return $e->getMessage();
      }
    }

    public function delete($id)
    {
      $sam = new Database();
      $kibalanga = $sam->connect();

      try {
         $sql = "DELETE FROM `responses` WHERE uid=:id";
         $stmt = $kibalanga->prepare($sql);
         $stmt->bindParam(":id", $id, PDO::PARAM_INT);

         if ($stmt->execute()) {
            return [
               "status" => "success",
               "message" => "Delete successful!"
            ];
         } else {
            return [
               "message" => "Delete fail!"
            ];
         }

      } catch (PDOException $e) {
         return $e->getMessage();
      }
    }
}
?>
<?php
    header("Content-type: application/json");
    require $include_path."class.database.php";
    require $include_path."class.errorlist.php";
 

    class Recipe{

        public function __construct($recipe) {
        
            $this->rcp_name = $recipe['rcp_name'];
            $this->rcp_desc = $recipe['rcp_desc'];
            $this->rcp_ing = $recipe['rcp_ing'];
            $this->rcp_time = $recipe['rcp_time'];
        }

        public function pushrecipe(){  
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList();
            
            if($this->rcp_name != null && $this->rcp_desc != null && $this->rcp_ing != null && $this->rcp_time != null){
                
                
            } else {
                $response["status"] = "failure";
                $response["error"]["err_code"] = 2;
                $response["error"]["err_desc"] = $errnum->errlist[2]; 
            }
                $mysqli -> close();
                return json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }

    $check = new Recipe($request);
    echo $check->pushrecipe();
    
?>
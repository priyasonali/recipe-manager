
<?php
    header("Content-type: application/json");
    require $include_path."class.database.php";
    require $include_path.'class.errorlist.php';
    

    class Users{

        public function __construct($credentials) {
        
            $this->user_email = $credentials['user_email'];
            $this->user_name = $credentials['user_name'];
            $this->user_pass = $credentials['user_pass'];
           

        }

        public function pushdata(){  
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList();
            
            if($this->user_email != null && $this->user_name != null && $this->user_pass != null){
                $result = $mysqli->query("SELECT * FROM users WHERE user_email='$this->user_email'")->num_rows;
                if($result>0)
                { 
                    $response["error"]["err_code"] = 0;  
                    $response["error"]["err_desc"] = $errnum->errlist[0];                
                } 
                else if(($mysqli->query("SELECT * FROM users WHERE user_name='$this->user_name'")->num_rows)>0){
                    $response["error"]["err_code"] = 1;  
                    $response["error"]["err_desc"] = $errnum->errlist[1];    
                }
                else           
                {
                    if($result = $mysqli->query("INSERT INTO users (user_email, user_name, user_pass, user_status) VALUES ('$this->user_email', '$this->user_name', '$this->user_pass', 'Pending')"))
                    {
                        $response["status"] = "Success"; 
                    } else { 
                        $response["status"] = "Failed"; 
                    }
                }
            } else {
                $response["error"]["err_code"] = 2;
                $response["error"]["err_desc"] = $errnum->errlist[2]; 
            }
                $mysqli -> close();
                return json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }

    $check = new Users($_REQUEST);
    echo $check->pushdata();
    
?>
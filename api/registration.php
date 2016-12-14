
<?php
    header("Content-type: application/json");
    require './includes/class.database.php';
    require './includes/class.errorlist.php';
    $response = array();
    

    class Users{

        public function __construct($uemail, $uname, $upass) {
        
            $this->user_email = $uemail;
            $this->user_name = $uname;
            $this->user_pass = $upass;

        }

        public function pushdata(){  
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;
            
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

    $check = new Users($_REQUEST["user_email"],$_REQUEST["user_name"],$_REQUEST["user_pass"]);
    echo $check->pushdata();
    
?>
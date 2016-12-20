<?php
    header("Content-type: application/json");
    require $include_path."class.database.php";
    require $include_path."class.errorlist.php";
 

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
                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 0;  
                    $response["error"]["err_desc"] = $errnum->errlist[0];   
                           
                } 
                else if(($mysqli->query("SELECT * FROM users WHERE user_name='$this->user_name'")->num_rows)>0){
                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 1;  
                    $response["error"]["err_desc"] = $errnum->errlist[1];    
                }
                else           
                {
                    $datacheck = 0;
                        $result=$mysqli->query("SELECT * FROM tmp_users WHERE tmp_email='$this->user_email'");
                        $row = $result->fetch_assoc();
                        $tmp_email = $row['tmp_email'];
                        $tmp_code = $row['tmp_code'];
                    if(($result->num_rows)>0){
                        if($tmp_code == 1){
                            $mysqli->query("DELETE FROM tmp_users WHERE tmp_email='$this->user_email'");
                            $datacheck=1;
                        } else {
                        $response["status"] = "failure";
                        $response["error"]["err_code"] = 7;  
                        $response["error"]["err_desc"] = $errnum->errlist[7]; 
                        }
                    }
                    else{
                        $response["status"] = "failure";
                        $response["error"]["err_code"] = 7;  
                        $response["error"]["err_desc"] = $errnum->errlist[7];  
                    }
                    if($datacheck==1){
                        if($result = $mysqli->query("INSERT INTO users (user_email, user_name, user_pass) VALUES ('$this->user_email', '$this->user_name', '$this->user_pass')"))
                        {
                            $response["status"] = "success"; 
                        } else { 
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 5;
                            $response["error"]["err_desc"] = $errnum->errlist[5];  
                        }
                    }
                }
            } else {
                $response["status"] = "failure";
                $response["error"]["err_code"] = 2;
                $response["error"]["err_desc"] = $errnum->errlist[2]; 
            }
                $mysqli -> close();
                return json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }

    $check = new Users($request);
    echo $check->pushdata();
    
?>
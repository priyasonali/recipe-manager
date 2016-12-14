<?php
    require '../vendors/class.jwt.php';
    require './includes/class.database.php';
    require './includes/class.errorlist.php';

    $authHeader = apache_request_headers()["authorization"];
    $token = JWT::decode($authHeader, enchanted);
    $uid = $token->user_id;

    class ResetPass{

        public function __construct($userPass, $userNewPass, $uid) {
        
            $this->userPass = $userPass;
            $this->userNewPass = $userNewPass;
            $this->uid = $uid;

        }

        public function reset(){
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;

            if($this->uid != null ){

                $result = $mysqli->query("SELECT * FROM users WHERE user_id=$this->uid");
                $row = $result->fetch_assoc();
                $userId = $row['user_id'];
                $user_pass = $row['user_pass'];


                if($userId != null && $userId == $this->uid && $user_pass == $this->userPass){
  
                    $result = $mysqli->query("UPDATE users SET user_pass='$this->userNewPass' WHERE user_id=$this->uid");
                    if($result===TRUE){
                        $response["status"] = "Success"; 
                        
                    }  
                    else{
                        
                    $response["status"] = "Failed";
                    $response["error"]["err_code"] = 5;
                    $response["error"]["err_desc"] = $errnum->errlist[5];
                    } 
                }
                else{
                    $response["status"] = "Failed";
                    $response["error"]["err_code"] = 6;
                    $response["error"]["err_desc"] = $errnum->errlist[6];
                }
                
            } else {
                $response["error"]["err_code"] = 3;
                $response["error"]["err_desc"] = $errnum->errlist[3];
            }
            $mysqli -> close();
            return json_encode($response, JSON_PRETTY_PRINT);
        }


    }
    $check = new ResetPass($_REQUEST["user_pass"],$_REQUEST["user_new_pass"], $uid);
    echo $check->reset();

?>

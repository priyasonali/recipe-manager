<?php
    require './includes/class.database.php';
    require './includes/class.errorlist.php';


    class ForgotPass{

        public function __construct($uemail, $upass) {
        
            $this->userEmail = $uemail;
            $this->userPass = $upass;

        }

        public function forgot(){
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;
   
            if($this->userEmail != null && $this->userPass != null){

                $result = $mysqli->query("SELECT * FROM users WHERE user_email = '$this->userEmail'");
                $row = $result->fetch_assoc();
                $user_email = $row['user_email'];

                if($user_email == $this->userEmail){
  
                    $result = $mysqli->query("UPDATE users SET user_pass='$this->userPass' WHERE user_email='$this->userEmail'");
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
                    $response["error"]["err_code"] = 4;
                    $response["error"]["err_desc"] = $errnum->errlist[4];
                }
                
            } else {
                $response["error"]["err_code"] = 2;
                $response["error"]["err_desc"] = $errnum->errlist[2];
            }
            $mysqli -> close();
            return json_encode($response, JSON_PRETTY_PRINT);
        }


    }
    $check = new ForgotPass($_REQUEST["user_email"],$_REQUEST["user_pass"], $uid);
    echo $check->forgot();

?>

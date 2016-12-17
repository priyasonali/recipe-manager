<?php
    header("content-type: application/json");
    require $include_path.'class.database.php';
    require $include_path.'class.errorlist.php';
    require $include_path_vendors.'vendors/class.jwt.php';
    $response = array();
    class Signin{

        public function __construct($uname, $upass) {
        
            $this->user_name = $uname;
            $this->user_pass = $upass;

        }
        

        public function pulldata(){  
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;

            $user_name = $mysqli->real_escape_string($this->user_name);

            if($this->user_name != null && $this->user_pass != null){

                $result = $mysqli->query("SELECT * FROM users WHERE user_name='$user_name'");
                $row = $result->fetch_assoc();
                $user = $row['user_name'];
                $pass = $row['user_pass'];

                if($user == $user_name && $pass == $this->user_pass && $result->num_rows > 0){
                    $response["status"] = "Logged in";
                    $uid["user_id"] = $row['user_id'];
                    $response ["authentication_token"]=  JWT::encode($uid, enchanted);

                   header('authorization:'.JWT::encode($uid, enchanted));

                }
                else{
                    $response["status"] = "Failed";
                }

            } else {
                $response["error"]["err_code"] = 2;
                $response["error"]["err_desc"] = $errnum->errlist[2]; 
            }
                          
            $mysqli -> close();
            return json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }

    $signin = new Signin($_REQUEST["user_name"],$_REQUEST["user_pass"]);
    echo $signin->pulldata();
    
?>
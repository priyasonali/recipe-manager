<?php
    header("content-type: application/json");
    require $include_path.'class.database.php';
    require $include_path.'class.errorlist.php';
    $response = array();

    class Validate{
        public $random;

        public function __construct($details) {
        
            $this->user_email = $details['user_email'];
            $this->user_code = $details['user_code'];
            $this->user_check = $details['user_check'];
            $this->random= mt_rand(100000,999999);

        }
        
        public function emailSend($random){
           $to = $this->user_email;
            $subject = "Email validation for recipe-manager account";
            $txt = "
                    <html>
                        <head>
                            <title>Recipe Manager</title>
                        </head>
                        <body>
                            <p>Please click on the following link to validate you email address. </p>
                            <br> <a href='localhost/recipe-manager/api?action=validate&user_email=$this->user_email&user_code=$random'>Click me !</a>
                            <br>
                            <b>Thank You</b>
                        </body>
                    </html>
                    ";
            $headers = "From: noreply@recipemanager.com" . "\r\n" .
            mail($to,$subject,$txt,$headers); 
        }

        public function compare(){  
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;

            if($this->user_email != null && $this->user_code != null){

                $result = $mysqli->query("SELECT * FROM tmp_users WHERE tmp_email='$this->user_email'");
                $row = $result->fetch_assoc();
                $email = $row['tmp_email'];
                $code = $row['tmp_code'];
                if($result->num_rows>0){
                    if($code==1){

                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 8;
                    $response["error"]["err_desc"] = $errnum->errlist[8]; 

                    }
                   else if($code==$this->user_code){
                       $mysqli->query("UPDATE tmp_users SET tmp_code='1' WHERE tmp_email='$this->user_email'");
                       $response["status"] = "Success";
                       $response["msg"] = "Your email is activated.";
                    }else{
                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 9;
                    $response["error"]["err_desc"] = $errnum->errlist[9]; 
                    }
                } else{
                    $result1 = $mysqli->query("SELECT * FROM users WHERE user_email='$this->user_email'");
                    $row1 = $result1->fetch_assoc();
                    $reg_email = $row1['user_email'];

                    if($reg_email == $this->user_email){
                        $response["status"] = "failure";
                        $response["error"]["err_code"] = 0;
                        $response["error"]["err_desc"] = $errnum->errlist[0]; 
                    }else{
                        $this->emailSend($this->random);
                        $result = $mysqli->query("INSERT INTO tmp_users (tmp_email, tmp_code) VALUES ('$this->user_email', '$this->random')");
                        $response["status"] = "failure";
                        $response["error"]["err_code"] = 7;
                        $response["error"]["err_desc"] = $errnum->errlist[7]; 
                    }
                }
            } else if($this->user_email != null && $this->user_code == null) {

                $result1 = $mysqli->query("SELECT * FROM users WHERE user_email='$this->user_email'");
                $row1 = $result1->fetch_assoc();
                $reg_email = $row1['user_email'];

                if($reg_email == $this->user_email){
                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 0;
                    $response["error"]["err_desc"] = $errnum->errlist[0]; 
                }else {
                 $result2 = $mysqli->query("SELECT * FROM tmp_users WHERE tmp_email='$this->user_email'");
                    $row2 = $result2->fetch_assoc();
                    $found_email = $row2['tmp_email'];
                    $found_code = $row2['tmp_code'];
                    $random1 = $row2['tmp_code'];
                    if($result2->num_rows>0){
                        if($found_code==1){
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 8;
                            $response["error"]["err_desc"] = $errnum->errlist[8];
                        }
                        else if($this->user_check == true){
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 7;
                            $response["error"]["err_desc"] = $errnum->errlist[7];
                        }else{
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 7;
                            $response["error"]["err_desc"] = $errnum->errlist[7];
                            $this->emailSend($random1);
                        }
                    } else{
                        $this->emailSend($this->random);
                        $result = $mysqli->query("INSERT INTO tmp_users (tmp_email, tmp_code) VALUES ('$this->user_email', '$this->random')");
                        $response["status"] = "failure";
                        $response["error"]["err_code"] = 7;
                        $response["error"]["err_desc"] = $errnum->errlist[7];
                    }

                }
            }else if(($this->user_email == null && $this->user_code == null) || ($this->user_email == null && $this->user_code != null)){
                $response["status"] = "failure";
                $response["error"]["err_code"] = 9;
                $response["error"]["err_desc"] = $errnum->errlist[9];
            }
                          
            $mysqli -> close();
            return json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }
    
    $validate = new Validate($request);
    echo $validate->compare();
    
?>
<?php
    header("Content-type: application/json");
    require $include_path.'class.database.php';
    require $include_path.'class.errorlist.php';


    class ForgotPass{

        public function __construct($uemail) {
        
            $this->userEmail = $uemail['user_email'];

        }

        public function forgot(){
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;
   
            if($this->userEmail != null){

                $result = $mysqli->query("SELECT * FROM users WHERE user_email = '$this->userEmail'");
                $row = $result->fetch_assoc();
                $user_email = $row['user_email'];
                $user_name = $row['user_name'];

                if($user_email == $this->userEmail){
                    $tem_pass = rand(111111, 99999999);
                    $to = $this->user_email;
                    $subject = "New password";
                    $txt = "
                            <html>
                                <head>
                                    <title>Recipe Manager</title>
                                </head>
                                <body>
                                    <p>Following is your new password and email: </p>
                                    <br>
                                    <b>Username: </b> $user_name <br>
                                    <b>Password:</b> $tem_pass<br>
                                    <b>Thank You</b>
                                </body>
                            </html>
                            ";
                    $headers = "From: noreply@recipemanager.com" . "\r\n" .
                    mail($to,$subject,$txt,$headers); 
                    if($mysqli->query("UPDATE users SET user_pass='$tem_pass' WHERE user_email = '$this->userEmail'")){
                    $response["status"] = "success";
                    }
                    else{
                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 5;
                    $response["error"]["err_desc"] = $errnum->errlist[5];

                    }
                }
                else{
                    $response["status"] = "failure";
                    $response["error"]["err_code"] = 4;
                    $response["error"]["err_desc"] = $errnum->errlist[4];
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
    $check = new ForgotPass($request);
    echo $check->forgot();

?>

<?php
    header("Content-type: application/json");
    require $include_path_vendors.'vendors/class.jwt.php';
    require $include_path.'class.database.php';
    require $include_path.'class.errorlist.php';

    $authHeader = apache_request_headers()["authorization"];
    $token = JWT::decode($authHeader, enchanted);
    $uid = $token->user_id;

    class Ingredient{

        public function __construct($ing, $uid) {
        
            $this->ing = $ing["ing_name"];
            $this->check = $ing["user_check"];
            $this->uid = $uid;

        }

        public function ingredientQyery(){
            $db = new Database;
            $mysqli = $db->connect();
            $errnum = new ErrorList;

            if($this->uid != null ){
                    
            if($this->ing!=null || $this->check == true){
                    $result = $mysqli->query("SELECT * FROM users WHERE user_id=$this->uid");
                    
                    if($result->num_rows>0){

                        if($this->check == true){
                            $result0 = $mysqli->query("SELECT ing_name FROM ingredients WHERE user_id=$this->uid");
                            while($row=$result0->fetch_assoc()){
                                $res[]=$row["ing_name"];
                            }
                            if($result0->num_rows>0){
                            $response["status"] = "success";
                            $response["result"] = $res;
                            }else{
                            $response["status"] = "failure";
                                $response["error"]["err_code"]= 11;
                                $response["error"]["err_desc"] = $errnum->errlist[11];
                            }
                        }else{

                        
                        $result1 = $mysqli->query("SELECT * FROM ingredients WHERE user_id=$this->uid AND ing_name='$this->ing'");
                        if($result1->num_rows>0){
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 10;
                            $response["error"]["err_desc"] = $errnum->errlist[10];
                        }else{
                            if($result2 = $mysqli->query("INSERT INTO ingredients (ing_name, user_id) VALUES ('$this->ing', $this->uid)")){
                            $response["status"] = "success";
                            }else {
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 5;
                            $response["error"]["err_desc"] = $errnum->errlist[5];

                            }
                        }
                    }
                    }else{
                            $response["status"] = "failure";
                            $response["error"]["err_code"] = 3;
                            $response["error"]["err_desc"] = $errnum->errlist[3];
                    }
            }else{

                $response["status"] = "failure";
                $response["error"]["err_code"] = 2;
                $response["error"]["err_desc"] = $errnum->errlist[2];
            }
                }
                else{
                $response["status"] = "failure";
                $response["error"]["err_code"] = 3;
                $response["error"]["err_desc"] = $errnum->errlist[3];
                }
            
            $mysqli -> close();
            return json_encode($response, JSON_PRETTY_PRINT);
        }


    }
    $check = new Ingredient($request, $uid);
    echo $check->ingredientQyery();

?>

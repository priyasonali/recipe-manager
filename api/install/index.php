<?php
header("Content-type: application/json");
require "../vendors/importer/importer/class.importer.php";

class importdb{

    public function __construct($details) {
    
        $this->db_name = $details["db_name"];
        $this->db_user = $details["db_user"];
        $this->db_pass = $details["db_pass"];
    }

    public function importsql(){

 
            $mysqlImport = new Importer("localhost", $this->db_user , $this->db_pass);
            $mysqlImport->doImport("rm.sql", $this->db_name, true);

            if ($mysqlImport->importerErrors){
                $response["status"] = "failure"; 
                $response["error"]["err_desc"]= $mysqlImport->errors;  
            } else {
                $response["status"] = "success";
            } 
            return json_encode($response, JSON_PRETTY_PRINT);
        }
       
}
    $check = new importdb($_REQUEST);
    echo $check->importsql();
?>

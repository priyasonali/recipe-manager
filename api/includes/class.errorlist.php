<?php 
  class ErrorList {
      public function __construct(){
          
          $this->errlist = array();  
          $this->errlist[0] = "This email is already registered.";
          $this->errlist[1] = "This username is taken.";
          $this->errlist[2] = "Please enter the details.";
          $this->errlist[3] = "Invalid login details.";
          $this->errlist[4] = "Invalid email address.";
          $this->errlist[5] = "Query failed.";
          $this->errlist[6] = "Invalid password.";
      }
}
?>
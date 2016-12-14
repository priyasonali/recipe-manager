<?php
  
  class Database {
	
	protected $db_name = 'storystream';
	protected $db_user = 'admin';
	protected $db_pass = '12345';
	protected $db_host = 'localhost';
	
	public function connect() {
	
		$mysqli = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );
		
		if ($mysqli->connect_error) {
      return false;
    } else {
      return $mysqli;
    }
	}

}
?>
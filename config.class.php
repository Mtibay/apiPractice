<?php 

class Config
{
	private $db_host;
    private $db_username;
    private $db_password;
    private $db_name;

	function __construct()
 	{ 
		$this->db_host = 'localhost';
		$this->db_username = 'root';
		$this->db_password = '1';
		$this->db_name = 'ipawnsafe';
 	} 

 	public function config_db()
 	{
		 $conn = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, 
		 $this->db_username, $this->db_password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
 	}
}
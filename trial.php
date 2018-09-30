<?php
session_start();
require_once('config.php');   
if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
	$type = $_REQUEST['type'];
	switch ($type) {
		case 'signin': 
			$array = array(
					"username"	=> $_REQUEST["username"],
					"password"	=> $_REQUEST["password"] 
			);
			$signin = new User(); 
			echo $signin->login($array); 
		break; 
		case 'logout':
			session_destroy(); 
		break;
		case 'signup': 
			$array = array(
					"fullname"	=> $_REQUEST["fullname"],
					"username"	=> $_REQUEST["username"],
					"password"	=> $_REQUEST["password"],
					"gender"	=> $_REQUEST["gender"]
			);
			$signup = new User();
			$signup->signup($array);
			//print_r("<pre>");print_r($array);print_r("</pre>");
			break;
		default: 
			break;
	}
}
class User{ 
	private $Database;
	private $conn;
	private $arrayUser;
	private $Config;  
	function __construct()
 	{ 
		$this->Database = '';
		$this->conn = '';   
		$this->arrayUser = array();
		$this->Config = new Config();  
 	} 
 	public function login($credentials){     
		$this->conn = $this->Config->dBase();	
		$smarty = $this->Config->dataConfig();
		$fullname = "";
		$sql = "SELECT * FROM guestbook.tbluser where username=:username and password=:password;"; 
		$query = $this->conn->prepare($sql);  
		$query->bindParam(':username', $credentials["username"]);
        $query->bindParam(':password', $credentials["password"]);  
		$query->execute(); 
		$arrayUser = $query->fetchAll();    
	    if(!isset($arrayUser[0]["fullname"]))
	    {
	     $fullname = "false"; 
	 	}
	 	else
	 	{ 
	 		$fullname = $arrayUser[0]["fullname"];  
	    	$_SESSION["fullname"] = $fullname;
	 	} 
	    return $fullname;   
	}
	public function signup($dataUser){
		$this->conn = $this->Config->dBase();   
		$sql = "INSERT INTO `guestbook`.`tbluser`
(
`fullname`,
`username`,
`password`,
`gender`)
VALUES
(
:fullname,
:username,
:password,
:gender);
"; 
       $query = $this->conn->prepare($sql); 
       $query->bindParam(':fullname', $dataUser["fullname"]);
       $query->bindParam(':username', $dataUser["username"]);
       $query->bindParam(':password', $dataUser["password"]); 
       $query->bindParam(':gender', $dataUser["gender"]);
       $query->execute();
	}
}

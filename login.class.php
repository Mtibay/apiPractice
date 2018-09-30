<?php
require_once( dirname( __FILE__ ) . '/config.class.php' );

$data = array(
  'username' => $_POST['uname'],
  'password' => $_POST['pass']
);
$broker = new loginApi();

class loginApi{
  
  private $conn;

  function __construct()
  {  
		$this->conn = new Config();    
   }
   
   public function login($data){  

		$conn = $this->conn->config_db();  
		$sql = 'SELECT * `IPawnSafe`.`login`
		(
      `username`,
      `password`
		)
		VALUES
		(
		  :username,
      :password 
		); WHERE `username` = :username && `password` = :password
		';  
       $query = $conn->prepare($sql); 
      $query->execute();
      
      if($query == true){
        // header('Location: /index.html');
        // return ['status' => 'Login Successful!'];
        echo 'working';
      }else{
        echo 'not working';
      }
       
  }
}

// echo json_encode($_POST);
echo json_encode($data);
echo json_encode($broker->login($data));
?>
<?php
require_once( dirname( __FILE__ ) . '/config.class.php' );


if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
	$type = $_REQUEST['type'];
	switch ($type) {
		case 'signin': 
			$data = array(
					'email'	=> $_REQUEST['email'],
					'password'	=> $_REQUEST['password'] 
			);
		// 	$data = array(
		// 		'username'	=> 'value',
		// 		'password'	=> 'value' 
		// );
			$signin = new brokerApi();
			echo json_encode($data); 
			// echo $signin->login($array);
			echo json_encode($signin->login($data)); 
		break; 
		case 'logout':
			session_destroy(); 
		break;
		case 'insert': 
			$array = array(
          'fullname'	=> $_REQUEST['fname'],
          'email'	=> $_REQUEST['email'],
          'phone'	=> $_REQUEST['number'],
					'password'	=> $_REQUEST['password'],
					'user_type'	=> $_REQUEST['user'],
					'address'	=> $_REQUEST['address'],
					'city'	=> $_REQUEST['city'],
					'img'	=> $_REQUEST['img'],
					'token'	=> $_REQUEST['token'],
					'date_reg'	=> $_REQUEST['date_reg'],
					'status'	=> '1'
			);
		// 	$array = array(
		// 		'fullname'	=> 'g',
		// 		'email'	=> 'g',
		// 		'phone'	=> '00909',
		// 		'password'	=> 'g',
		// 		'user_type'	=> 'g',
		// 		'address'	=> 'g',
		// 		'city'	=> 'g',
		// 		'status'	=> '1'
		// );
		// 	$array = array(
		// 		'full_name'	=> 'g',
		// 		'email_address'	=> 'g',
		// 		'phone_number'	=> 'g',
		// 		'username'	=> 'g',
		// 		'password'	=> 'g',
		// 		'user_role'	=> 'g'
		// );
			$signup = new brokerApi();
			// $signup->signup($array);
			echo json_encode($array);
      echo json_encode($signup->insert($array));
			//print_r("<pre>");print_r($array);print_r("</pre>");
			break;
		default: 
			break;
	}
}



// $data = array(
//   'full_name' => $_POST['fname'],
//   'email_address' => $_POST['email'],
//   'phone_number' => $_POST['number'],
//   'username' => $_POST['uname'],
//   'password' => $_POST['pass'],
//   'user_role' => $_POST['user']
// );
$broker = new brokerApi();

class brokerApi{
  
  private $conn;

  function __construct()
  {  
		$this->conn = new Config();    
   }
   
   public function insert($array){  

		$conn = $this->conn->config_db();  
		$sql = 'INSERT INTO `ipawnsafe`.`user_table`
		(
			`fullname`,
			`email`,
      `phone`,
      `password`,
      `user_type`,
			`address`,
			`city`,
			`status`,
			`img`,
			`token`,
			`date_reg`
		)
		VALUES
		(
			:fullname,
			:email,
      :phone,
      :password,
      :user_type,
			:address,
			:city,
			:img,
			:token,
			:date_reg,
			:status
		);
		';  
       $query = $conn->prepare($sql); 
       $query->bindParam(':fullname', $array["fullname"]);
       $query->bindParam(':email', $array["email"]);
       $query->bindParam(':phone', $array["phone"]);
       $query->bindParam(':password', $array["password"]);
			 $query->bindParam(':user_type', $array["user_type"]);
			 $query->bindParam(':address', $array["address"]);
			 $query->bindParam(':city', $array["city"]);
			 $query->bindParam(':status', $array["status"]);  
			 $query->bindParam(':img', $array["img"]);
			 $query->bindParam(':token', $array["token"]);
			 $query->bindParam(':date_reg', $array["date_reg"]);
       $query->execute();
       return ['status' => 'Successfully Added']; 
  }

  public function login($credentials){     
		$conn = $this->conn->config_db(); 
		$fullname;
		$greet = "Welcome!";
		$sql = "SELECT * FROM `ipawnsafe`.`user_table` WHERE email=:email and password=:password;"; 
		$query = $conn->prepare($sql);  
		$query->bindParam(':email', $credentials["email"]);
    $query->bindParam(':password', $credentials["password"]);  
		$query->execute(); 
		// return ['status' => 'Successfully loged in!'];
		$arrayUser = $query->fetchAll();    
	    if(!isset($arrayUser[0]["fullname"]))
	    {
			//  $fullname = "false"; 
			 echo 'Wrong Username or Password!!!';
	 	}
	 	else
	 	{ 
	 		$fullname =  $arrayUser[0]['fullname'];  
				$_SESSION["fullname"] = $fullname;
				echo 'Loged in! Successfuly!';
				echo $greet;
		 } 
		return $fullname;
	}
	

}

// echo json_encode($_POST);
// echo json_encode($data);
// echo json_encode($signup->insert($array));
?>
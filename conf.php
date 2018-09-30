<?php

  $host = "localhost";
  $username = "root";
  $password = "1";
  $database = "IPawnSafe";
  
  try{
    $connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Success!';

    $query = "INSERT INTO `login`(`first_name`, `email_address`) VALUES ('marvs', 'email ko')";
    
    $connect->exec($query);
    echo 'insert na!';

    // $statement = $connect->prepare(
    //   "INSERT INTO `login`(`full_name`, `email_address`) 
    //   VALUES (:full_name, :email_address)"
    // );
    // $statement->execute(array(
    //   'full_name' => 'name',
    //   'email_address' => 'email ko'
    // ));
    // echo 'pasok!';
  }
  catch(PDOExeption $error){
    echo $error->getMessage();
  }

?>
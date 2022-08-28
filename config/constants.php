<?php 

   //start session 
   session_start();
   
  //creat constants to store non repeating values 
  define('SITEURL','http://localhost/e_commerce/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','ecommerce');

  $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn)); //database coonection
  $db_select = mysqli_select_db($conn,DB_NAME)or die (mysqli_error($conn));
?>
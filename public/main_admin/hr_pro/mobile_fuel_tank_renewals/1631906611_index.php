<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
 {
    $name = $_POST["username"];
    $email = $_POST["email12"];
    $password = $_POST["password12"];


  echo $name;
  echo '<br>';
  echo $email;
  echo '<br>';
  echo $password;


  $server_name = "localhost";
  $username = "root";
  $password = "";
$con = mysqli_connect($server_name , $username , $password)


 }


?>
<?php

    $servername = "localhost";
    $username = "id20678794_technical";
    $password = "BZOa9O7^xH27PBs]";
    $dbname = "id20678794_offices";

  // Data Source Network
$conn = mysqli_connect($servername ,$username, $password, $dbname);

 if($conn){
  //  echo "connection ok";
 }
 else{
 //   echo "connection failed".mysqli_connect_error();
 }
 
?>
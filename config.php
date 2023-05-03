<?php
    $servername = "localhost";
    $username = "id20678794_technical";
    $password = "BZOa9O7^xH27PBs]";
    $dbname = "id20678794_offices";
    
  // Data Source Network
  $dsn = 'mysql:host=' . $servername . ';dbname=' . $dbname . '';

  // Connection Variable
  $conn = null;

  // Connect Using PDO (PHP Data Output)
  try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die('Error : ' . $e->getMessage());
  }
?>


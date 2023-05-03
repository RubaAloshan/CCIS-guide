<?php
  require_once 'config.php';

  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql1 = 'SELECT First_Name FROM offices WHERE First_Name LIKE :firstname';
    $stmt = $conn->prepare($sql1);
    $stmt->execute(['firstname' => '%' . $inpText . '%']);
    $result1 = $stmt->fetchAll();

    $sql2 = 'SELECT Office_Name FROM offices WHERE Office_Name LIKE :office';
    $stmt = $conn->prepare($sql2);
    $stmt->execute(['office' => '%' . $inpText . '%']);
    $result2 = $stmt->fetchAll();
    $stmt->setFetchMode(PDO:: FETCH_OBJ);


    if ($result1) {
      foreach ($result1 as $row) {
        echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['First_Name'] . '</a>';
      }
    }
  
  if ($result2) {
    foreach ($result2 as $row) {
      echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['Office_Name'] . '</a>';
    }
  }
  }
?>
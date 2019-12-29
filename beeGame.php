<?php
include "./Classes/Hive.php";
session_start();

if(isset($_SESSION["hive"])){
  $hive = $_SESSION["hive"];
  $hive->hitRandomBee();
} else{
  $hive = new Hive();
}

$_SESSION["hive"] = $hive;

if($hive->allDead()){
  $hive = new Hive();
  $_SESSION["hive"] = $hive;
}

?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style.css">
  </head>
  <body>

    <div class="title">The Bee Game </div>
    <div class="container">
    <div class="row">
    <?php

    $stats = $hive->getBeePoints();
    for($i = 0; $i < count($stats); $i++){
      if($stats[$i]->type == "Queen Bee" && $stats[$i]->health == 0){
        $hive = new Hive();
        header('Location: '.$_SERVER['REQUEST_URI']);
      }

      if($stats[$i]->lasthit) echo "<div class='lasthit col-sm-1'>";
      else echo "<div class='col-sm-1'>";
      echo("<div class='bee-type'>" . $stats[$i]->type . "</div>");
      echo("<div class='bee-health'>" . $stats[$i]->health . "</div>");
      echo "</div>";
    }

    ?>
    </div>
    </div>
    <a class="bee-button" href="./beeGame.php">HIT</a>
  </body>
</html>
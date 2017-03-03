<?php 
  session_start(); 
  include "db.php";
  include "functions.php";
?> 
<!DOCTYPE html>
<html lang="SV-se">
  <head>
    <title>Bloggprojekt Grupp 3 </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Bangers|Passion+One|Rock+Salt|Lato|Permanent+Marker|Oswald|Cabin+Sketch|Kumar+One|Sigmar+One" rel="stylesheet">
  </head>
  <body>
    <header>
      <nav class="dropdown">
        <div class="logo-image"></div>
        <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
        <ul class="dropdown-content">
          <li><a href="index.php" class="color-one">Start</a></li>
          <li><a href="info.php" class="color-two">Om Livebloggen</a></li>
          <!--<li><a href="archive.php" class="color-three">Arkiv</a></li>-->
          <li><a href="categories.php" class="color-four">Kategorier</a></li>
          <li><a href="dashboard.php" class="color-five">Mina sidor</a></li>
          <?php 
          if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
            echo "<li><a href='logout.php' class='color-six'>Logga ut</a></li>";
          } else {
            echo "<li><a href='login.php' class='color-six'>Logga in</a></li>";
          } 
          ?>
        </ul>
      </nav>
    </header>
    <main>

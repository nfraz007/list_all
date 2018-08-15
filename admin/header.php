<?php require_once '../include/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?=$NAME?> | Admin</title>

  <!-- CSS  -->
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index" class="brand-logo w3-hover-text-blue-grey"><?=$NAME?><span class="w3-small" id="page_name"></span></a>
      <ul class="right hide-on-med-and-down">
        <?php
          if(isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]!=""){
            echo '<li><a href="home.php" class="w3-hover-blue-grey">Home</a></li>';
            //echo '<li><a href="category.php" class="w3-hover-blue-grey">Category</a></li>';
            //echo '<li><a href="website.php" class="w3-hover-blue-grey">Website</a></li>';
            echo '<li><a class="dropdown-button w3-blue-grey" data-activates="profile_dropdown" data-beloworigin="true">'.$_SESSION["fname"].' '.$_SESSION["lname"].'</a></li>';
            echo '<ul id="profile_dropdown" class="dropdown-content">';
              //echo '<li><a href="settings.php" class="w3-text-blue-grey">Settings</a></li>';
              echo '<li><a class="logout_btn w3-text-blue-grey">Logout</a></li>';
            echo '</ul>';
          }else{
            echo '<li><a href="#login" class="w3-hover-blue-grey">Login</a></li>';
          }
        ?>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <?php
          if(isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]!=""){
            echo '<li><a class="w3-blue-grey">'.$_SESSION["fname"].' '.$_SESSION["lname"].'</a></li>';
            echo '<li><a href="home.php" class="w3-hover-blue-grey">Home</a></li>';
            //echo '<li><a href="category.php" class="w3-hover-blue-grey">Category</a></li>';
            //echo '<li><a href="website.php" class="w3-hover-blue-grey">Website</a></li>';
            //echo '<li><a href="settings.php" class="w3-text-blue-grey">Settings</a></li>';
            echo '<li><a class="logout_btn w3-text-blue-grey">Logout</a></li>';
          }else{
            echo '<li><a href="#login" class="w3-hover-blue-grey">Login</a></li>';
          }
        ?>
        ?>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse w3-text-blue-grey"><i class="fa fa-bars"></i></a>
    </div>
  </nav>

<!-- Login Modal Structure -->
<div id="login" class="modal">
  <div class="modal-content">
    <div class="row">
      <div class="input-field col s12">
        <input id="login_email" type="email" class="validate" value="admin@gmail.com">
        <label for="login_email">Email</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="login_password" type="password" class="validate" value="123456">
        <label for="login_password">Password</label>
      </div>
    </div>
    <div class="row w3-center">
      <button class="waves-effect waves-light btn w3-blue-grey" id="login_btn">Login</button>
    </div>
  </div>
</div>
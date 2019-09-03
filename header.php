<?php require_once 'include/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?=$NAME?></title>

  <!-- CSS  -->
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index" class="brand-logo w3-hover-text-blue-grey"><?=$NAME?></a>
      
      <ul class="right hide-on-med-and-down">
        <li><a href="admin" class="w3-hover-blue-grey">Admin Panel</a></li>
      	<li><a href="http://nfraz.co.in" class="w3-hover-blue-grey" target="_blank">Create by Nazish Fraz</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="admin" class="w3-hover-blue-grey">Admin Panel</a></li>
      	<li><a href="http://nfraz.co.in" class="w3-hover-blue-grey" target="_blank">Create by Nazish Fraz</a></li>
      </ul>

      <a href="#" data-activates="nav-mobile" class="button-collapse w3-text-blue-grey"><i class="fa fa-bars"></i></a>
    </div>
  </nav>
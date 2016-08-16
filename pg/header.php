<?php 

// establish connection to database
include ("connection.php");
// starting session
session_start();

if(!isset($_SESSION['user_login'])){
 //echo "false";
	$user="";
}else
{
  $user = $_SESSION['user_login'];
}

?> 

<!DOCTYPE html>
<html>	
<head>
	<title>Profile</title>
	<link rel="stylesheet" href="../pg/log.css">
</head>	
<body>	
  <div id ="wrapper">
  	<div id ="header">
	 <h1>Kyurious Minds </h1>
	 <h2>"Ask.Learn.Repeat "</h2>
 	 </div>
	 
    <?php
     if(!$user){
      echo '<ul id="nav">
     <li><a href="../home.html">Home</a></li>
     <li><a href="../sign/signup.html">Sign up </a></li>
	 <li><a href="../login/login.php">login </a></li>
	 </ul>';}
	 else{
	 	 echo '<ul id="nav">
     <li><a href="../pg/home.php">Home</a></li>
     <li><a href="../profile/'.$user.'">Profile</a></li>
     <li><a href="../profile/account_setting.php">Settings</a></li>
      <li><a href="../profile/search.php">Search</a></li>
	 <li><a href="../pg/logout.php">logout </a></li>
	 </ul>';
	 }

    ?>
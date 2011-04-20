<?php
session_start();
include 'functions.php';
if(!isset($_SESSION['uvuser'])) {
	if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
		login($_COOKIE['cookname'], $_COOKIE['cookpass']);
	}else{
		$currentFile = $_SERVER["PHP_SELF"];
		$parts = Explode('/', $currentFile);
		if ($parts[count($parts) - 1] != "login.php"){
			Header("Location: login.php");
		}
	}
}else{
	$details = details($_SESSION['uvuser']);
	$firstname = $details['firstname'];
	$lastname = $details['lastname'];
	$rank = $details['rank'];	
}
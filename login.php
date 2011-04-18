<?php
/**
 * @file login.php
 * @author Umang Vaish
 * @copyright 2011
 */
 
session_start();
include "mysql.php";
if(isset($_GET['error'])){
	$error = '<div class="message error close" id="warning"><h2>Incorrect ' . $_GET['error'] . '</h2><p>Oops! Your ' . $_GET['error'] . ' is wrong. Please try again.</p></div>';
}
function login($user,$pass){
			$mysql = new mysql();
			$mysql->connect("umangv_admin");
			$q="SELECT * from login where username='" . $_POST['username'] . "' and password='" . md5($_POST['password']) ."'";
			$result = $mysql->query($q);

			if (!$result || (mysql_numrows($result) < 1)){
				Header("Location: login.php?error=login");
			} else {
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['password'] = md5($_POST['password']);
				if(isset($_POST['remember'])){
					 setcookie("cookname", $_POST['username'], time()+60*60*24*100, "/");
					 setcookie("cookpass", $_POST['password'], time()+60*60*24*100, "/");
				}
				Header("Location: index.php");
			}
}

if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'logout':
			unset($_SESSION['username']);
			if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
			   setcookie("cookname", "", time()-60*60*24*100, "/");
			   setcookie("cookpass", "", time()-60*60*24*100, "/");
			}
			Header("Location: login.php");
		break;
		case 'checkuser':
			login($_POST['username'],$_POST['password']);
		break;
	}
}
if(isset($_SESSION['username'])) {
	Header("Location: index.php");
}
if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
	login($_COOKIE['cookname'], $_COOKIE['cookpass']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Meta -->
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<!-- End of Meta -->
		
		<!-- Page title -->
		<title> Admin - Login</title>
		<!-- End of Page title -->
		
		<!-- Libraries -->
		<link type="text/css" href="css/login.css" rel="stylesheet" />	
		<link type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.html" rel="stylesheet" />	
		
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/easyTooltip.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
		<!-- End of Libraries -->	
	</head>
	<body>
	<div id="container">
		<div class="logo">
			<a href="#"><img src="assets/logo.png" alt="" /></a>
		</div>
		<div id="box">
			<?php
			echo $error;
			?>
			<form action="login.php?action=checkuser" method="POST">
			<p class="main">
				<label>Username: </label>
				<input name="username" value="" /> 
				<label>Password: </label>
				<input type="password" name="password" value="">	
			</p>

			<p class="space">
				<span><input name="remember" type="checkbox" />Remember me</span>
				<input type="submit" name="login" value="Login" class="login" />
			</p>
			</form>
		</div>
	</div>

	</body>
</html>
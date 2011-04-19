<?php
/**
 * @file login.php
 * @author Umang Vaish
 * @copyright 2011
 */
 
include 'auth.php';
if(isset($_SESSION['uvuser'])){
	Header("Location: index.php");
}
if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'logout':
			logout();
		break;
		case 'error':
			switch($_GET['error']){
				case 'user':
					$message = "Your username and/or password is wrong. Please try again.";
				break;
				case 'blank':
					$message = "You left a field blank! Please try again.";
				break;
			}
			$error = '<div class="message error close" id="warning"><h2>Oops!</h2><p>' . $message . '</p></div>';
		break;
		case 'login':
			if(!$_POST['username'] || !$_POST['password']){
				Header("Location: login.php?action=error&error=blank");
			}else{
				login($_POST['username'],$_POST['password']);
			}
		break;
	}
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
			<a href="login.php"><img src="assets/logo.png" alt="" /></a>
		</div>
		<div id="box">
			<?php
			echo $error;
			?>
			<form action="login.php?action=login" method="POST">
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
<?php include_once("analyticstracking.php") ?>
	</body>
</html>
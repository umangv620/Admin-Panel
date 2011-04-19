<?php
include 'mysql.php';
function login($user,$pass){
			$mysql = new mysql();
			$mysql->connect("umangv_admin");
			$q="SELECT * from login where username='" . stripslashes($user) . "' and password='" . md5($pass) ."'";
			$result = $mysql->query($q);

			if (!$result || (mysql_numrows($result) < 1)){
				Header("Location: login.php?action=error&error=user");
			} else {
				$_SESSION['uvuser'] = stripslashes($user);
				$_SESSION['uvpass'] = md5($pass);
				if(isset($_POST['remember'])){
					 setcookie("cookname", $user, time()+60*60*24*100, "/");
					 setcookie("cookpass", $pass, time()+60*60*24*100, "/");
				}
					Header("Location: index.php");
			}
			
			
}
function details($user){
	$mysql = new mysql();
	$mysql->connect("umangv_admin");
	$q="SELECT * from login where username='" . $user . "'";
	$result = $mysql->query($q);
	if (!$result || (mysql_numrows($result) < 1)){
		logout();
	} else {
	while($row = mysql_fetch_array($result)){
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$rank = $row['rank'];
	}
	$details = array("firstname"=>$firstname, "lastname"=>$lastname,"rank"=>$rank);
	return $details;
	}
}
function logout(){
	unset($_SESSION['uvuser']);
	if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
		setcookie("cookname", "", time()-60*60*24*100, "/");
		setcookie("cookpass", "", time()-60*60*24*100, "/");
	}
	Header("Location: login.php");
}
?>
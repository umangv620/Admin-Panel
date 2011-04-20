<?php
include 'mysql.php';

function login($user,$pass){
			$mysql = new mysql();
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
	$q="SELECT * from login where username='" . $user . "'";
	$result = $mysql->query($q);
	if (!$result || (mysql_numrows($result) < 1)){
		logout();
	} else {
		while($row = mysql_fetch_array($result)){
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$rank = $row['rank'];
			return $row;
		}
		$details = array("firstname"=>$firstname, "lastname"=>$lastname,"rank"=>$rank);
		//return $details;
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

function create_nav($ap, $close=false){
	define('LB',chr(10));
	$output = "";
	if(is_array($ap)){
		$count = count($ap);
		$i=1;
		foreach($ap as $k => $v){
			$output .= '<li><a href="'.$v['url'].'">'.$v['title'].'</a>';
			if($v['dd']){
				$output .= '<ul>'.LB;
				$output .= create_nav($v['dd'],true);
			}
			if($close==true && $i==$count){
				$output .= LB.'</ul>';
			}
			$output .= '</li>'.LB;		
			$i++;
		}
		return $output;
	}
}

function check_access(){
	$details = details($_SESSION['uvuser']);
	$rank = $details['rank'];
	$a_q = $mysql->query("SELECT pages FROM access_levels WHERE id='".$rank."' LIMIT 1");
    $a = $mysql->fetch_assoc($a_q);
    $allowed_pages = unserialize($a['pages']);
    $parts = explode('/',$_SERVER['REQUEST_URI']);
    $count = count($parts);
    if(!in_array($parts[$count-1],$allowed_pages)){ 
		header('Location: index.php');
		exit;
    }
}
?>
<?php

session_start();

include "mysql.php";

$username = $_POST['username'];
$password = $_POST['password'];
$mysql = new mysql();
$mysql->connect($db);


$q="SELECT * from login where username='" . $username" . ' and password=' . "$password" . '";
$mysql->query($q);

if (mysql_num_rows($result) == 0)
{

echo "<div align=center><b>Oops! Your login is wrong. Please click back and try again.</b></div>";

}
else
{
$r=mysql_fetch_array($result);
$login_username=$r["username"];
session_register("login_username");
Header("Location: protected.php");
}
?>
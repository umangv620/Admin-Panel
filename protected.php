<?
session_start();
if(isset($_SESSION['username'])) {
Header("Location: index.php");
} else {

header("Location: login.html");
}
?>
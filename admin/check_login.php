<?php 

if(!$_COOKIE["auto_login"]){
	if(!isset($_SESSION['admin_name']) || empty($_SESSION['admin_name']) || !($_SESSION['is_login'])){
	show_msg("请重新登录","login.php");
	}
}



?>
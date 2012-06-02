<?php
@session_start();
$username = $_GET['username'];
$password = $_GET['password'];



if (!isset($_SESSION['user_id'])){
	$user_data = user_login($username,$password);
	$_SESSION['user_id'] = $user_data['UserID'];
	$_SESSION['username'] = $user_data['UserName'];
	$_SESSION['role'] = $user_data['Role'];
} else {
	$user_data = get_user($_SESSION['user_id']);
	$_SESSION['user_id'] = $user_data['UserID'];
	$_SESSION['username'] = $user_data['UserName'];
	$_SESSION['role'] = $user_data['Role'];
}

var_dump($user_data);
var_dump($_SESSION);
if (count($user_data)){
	
	
	
	
	if ($user_data['Role'] == 'user'){
		@header('location: client/index.php');
		//exit(0);
	} else {
		@header('location: index.php?action=incident');
		//exit(0);
	}
} else {
	include_once 'login.html';
}	
?>
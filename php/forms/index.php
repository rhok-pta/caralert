<?php
global $_GET;

$_REQUEST = array_merge($_GET, $_POST);

$action = $_REQUEST['action'];

@session_start();

$action = $_GET['action'];

switch($action){
	case 'adduser':
		include_once 'auth.php';
		include_once 'user.html';
		break;
	case 'addgroup':
		include_once 'auth.php';
		include_once 'group.html';
		break;
	case 'addincident':
		include_once 'auth.php';
		include_once 'incident.html';
		break;
	default:
		include_once 'login.html';
		break;
}
?>


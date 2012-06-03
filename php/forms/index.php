<?php
global $_POST;

//var_dump($_POST);
$action = $_POST['action'];
switch($action){
	case 'adduser':
		include_once 'user.html';
		//break;
	case 'addgroup':
		include_once 'group.html';
		//break;
	case 'addincident':
		include_once 'incident.html';
		//break;
		
	default:
		include_once 'user.html';
		include_once 'group.html';
		include_once 'incident.html';
		include_once 'login.html';
		//break;
}
?>


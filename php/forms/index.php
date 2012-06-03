<?php
global $_GET;
global $_POST;
$_REQUEST = array_merge($_GET, $_POST);
//var_dump($_POST);
$action = $_REQUEST['action'];
switch($action){
	case 'adduser':
		include_once 'user.html';
		break;
	case 'addgroup':
		include_once 'group.html';
		break;
	case 'addincident':
		include_once 'incident.html';
		break;
		
	default:

		include_once 'login.html';
		break;
}
?>


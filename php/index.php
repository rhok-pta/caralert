<?php
include_once 'data/db.php';

include_once 'request/get.php';
if (isset($_REQUEST['json'])){
	include_once 'request/json.php';
	exit;
}
include_once 'forms/header.html';
include_once 'forms/nav.html';
include_once 'forms/index.php';
include_once 'forms/footer.html';
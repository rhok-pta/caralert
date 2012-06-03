<?php

$request = $_REQUEST;

$request = sanitize($request);

$query = $request['q'];



switch($query){
  case 'list_user':
    $data = list_user();
    break;
  case 'list_group':
    $data = list_group();
    break;
  case 'list_user_group':
    $data = list_user_group();
    break;
  case 'list_incident':
    $data = list_incident();
    break;
  default:
    // not a valid request
    $data = false;
    return;
}

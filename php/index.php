<?php
include_once 'data/db.php';
include_once 'request/get.php';
include_once 'request/json.php';


/**
 * sanitize data
 */
function sanitize($data){
  foreach ($data as $key => $input){
    if (!is_array($input)){
      $clean[$key] = check_plain($input);
    } else {
      $clean[$key] = sanitize($input);
    }
  }
  return $clean;
}

/**
 * clean data
 */
function clean(&$data){
  foreach($data as $key => $post){
    if (is_array($post)){
      clean($post);
    } else {
      $clean[$key] = strip_tags(clean_sql($post));
    }
  }
  $data = $clean;
}

function clean_post($data){
  return sanitize($data);
}

function clean_sql($data){
  return mysql_real_escape_string($data);
}

function check_plain($text){
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function json_output($json){
  header('Content: application/json');
  echo $json;
}


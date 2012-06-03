<?php
error_reporting(0);
global $connection, $dns, $pdo;

$yaml_file = dirname (__FILE__) . '/connection.yaml';
//$connection = yaml_parse_file($yaml_file);
$connection = array('db_host' => 'localhost',
				    'db_name' => 'caralert',
					'db_user' => 'caralert',
					'db_pass' => 'grindel',
					);


try {
  $dns = 'mysql:host=' . $connection['db_host'] . ';dbname=' .    $connection['db_name'];
  $dbh = new PDO($dns, $connection['db_user'], $connection['db_pass']);
} catch (PDOEXception $e){
  die('Connection failed: ' . $e->getMessage())."\n";
}

$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

/**
 * database helper functions
 */


/**
 * list all users in the user table
 * @return array $result An array list of all users
 */
function list_user(){
  global $dbh;
  $query = "SELECT * FROM UserTbl";
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function list_group(){
  global $dbh;
  $query = "SELECT * FROM GroupTbl";
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function list_user_group(){
  global $dbh;
  $query = "SELECT * FROM UserGroupTbl";
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function list_incident(){
  global $dbh;
  $query = "SELECT * FROM IncidentTbl";
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function add_user($username, $password, $firstname, $surname, $cellnumber){	
  global $dbh;
  $query = "CALL User_Insert_byPK({$username},{$password},{$firstname},{$surname},{$cellnumber});";
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetch();
  return $result;
}

function add_group($area, $description){	
  global $dbh;
  $query = "CALL Group_Insert_byPK({$area},{$description});"; 
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetch();
  return $result;
}

function add_incident($user_id, $registration_no, $color, $makemodel, $description, $group_id){	
  global $dbh;
  $query = "CALL Incident_Insert_byPK({$user_id},{$registration_no},{$color},{$makemodel},{$description},now(), {$group_id});";
  $sth = $dbh->prepare($query);
  $sth->execute();
  $result = $sth->fetch();
  return $result;	
}


function count_user(){
  return count(list_user());
}

function count_group(){
  return count(list_group());
}

function count_user_group(){
  return count(list_user_group());
}

function count_incident(){
  return count(list_incident());
}


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
  if ($json != 'false'){
    header('Content: application/json');
    echo $json;
  }
}

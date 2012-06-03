<?php

global $connection, $dns, $pdo;

/*

if ($db->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') {
    $stmt = $db->prepare('select * from foo', array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
} else {
    die("connected to mysql data");
}
*/

$yaml_file = dirname (__FILE__) . '/connection.yaml';
$connection = yaml_parse_file($yaml_file);


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

function get_user(){
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

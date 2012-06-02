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
  $pdo = new PDO($dns, $connection['db_user'], $connection['db_pass']);
} catch (PDOEXception $e){
  die('Connection failed: ' . $e->getMessage())."\n";
}

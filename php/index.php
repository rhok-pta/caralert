<?php

include_once 'request/get.php';

include_once 'data/db.php';

include_once 'request/json.php';


$data = get_users();


$data = array('UserID'    => 1,
              'Password'  => 'test',
              'GroupID'   => 1);













function get_users(){
  global $pdo;
  $query = "SELECT *
            FROM UserTbl";

  $sth = $pdo->prepare($query);
  //$sth->bindParam(':name', $_GET['name']);
  $sth = $pdo->query($query);

  $result =  $sth->execute($sth);
  return $result;
}



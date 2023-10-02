<?php
date_default_timezone_set('Africa/Khartoum');

$dsn ='mysql:host=localhost;dbname=resturant'; $user = 'root'; $pass = ''; $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
try{ $con = new PDO($dsn, $user, $pass, $option); $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); }
catch(PDOException $e) { echo 'no conect' . $e->getMessage();
}

// echo $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'salesmanagement';

<?php

session_start();

require_once __DIR__ . '/autoload.php';

$parts = explode('/', $_SERVER['REQUEST_URI']);



$ctrlRequest = !empty($parts[1]) ? $parts[1] : 'Index';
$ctrlClassName = '\App\Controllers\\' . $ctrlRequest;
$ctrl = new $ctrlClassName;

$actRequest = !empty($parts[2]) ? $parts[2] : 'Default';
$actMethodName = 'action' . $actRequest;




try {

$ctrl->$actMethodName();

} catch (Exception $e) {

echo 'Error: ' . $e->getMessage();

}



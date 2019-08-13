<?php

require 'start.php';
require_once 'controllers/MainController.php';
require_once 'controllers/user.php';
use \Controllers\Users; 
$user = Users::create_user("user1","user1@example.com","user1_pass");

$user = $_GET['user'];
$file = $_GET['file'];
echo 'User: ' . $user. ', file: ' . $file;
require_once 'controllers/'.$user.'.php';
$userController = new Controllers\Users;

// require_once 'controllers/'.$file.'.php';
// $fileController = new $file;

$data['username'] = $user;
\Controllers\Controller::render($file, $data);
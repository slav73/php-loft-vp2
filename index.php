<?php

require 'start.php';
require_once 'controllers/MainController.php';

$user = $_GET['user'];
$file = $_GET['file'];
echo 'User: ' . $user. ', file: ' . $file;
require_once 'controllers/'.$user.'.php';
$userController = new $user;

// require_once 'controllers/'.$file.'.php';
// $fileController = new $file;

$data['username'] = $user;
\Controllers\Controller::render($file, $data);
<?php
ini_set('include_path',
    ini_get('include_path') . PATH_SEPARATOR .
    '../App'
);

require '../vendor/autoload.php';
require 'config.php';
<?php
namespace Controllers;

class Controller
 {
    public function render($name, $data) {
        require 'views/'.$name.'.php';
    }
 }
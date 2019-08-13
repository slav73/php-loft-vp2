<?php
 
namespace Controllers;
require_once 'models/user.php';
require_once 'db.php';

use Models\User;
 
class Users {
     
    public static function create_user($username, $email, $password){
        $user = User::create(['name'=>$username,'email'=>$email,'password'=>$password]);
        return $user;
    }

    public static function get_user($user_id){
        $db = DB::instance();
        $select = "SELECT * FROM users WHERE email = :email";
        $data = $db->fetchOne($select, __METHOD__, ['email' => $email]);
        if (!$data) {
            return false;
        }

        $user = new self($data['name'], $data['email'], $data['phone']);

        return $user;
    }   
}
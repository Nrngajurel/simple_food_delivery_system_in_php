<?php
require_once __DIR__ .'/model.php';

class User extends Model
{
    protected $table = 'users';

    public function isRegistered($email, $password){
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $this->db->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return false;
    }
}
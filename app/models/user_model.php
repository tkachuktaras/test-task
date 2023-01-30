<?php

class User_Model extends Model
{
    protected $table = 'user';

    public function save_user($email, $pass){
        $hash_pass = md5(md5($pass) . get_salt());
        $this->conn->query("INSERT INTO $this->table (u_email, u_pass) VALUES ('$email', '$hash_pass')");

        return $this->conn->insert_id;
    }

    public function get_user_by_id($id){
        return $this->conn->query("SELECT * FROM $this->table WHERE u_id='$id'");
    }

    public function get_user_by_email($email){
        return $this->conn->query("SELECT * FROM $this->table WHERE u_email='$email'");
    }

    public function user_out($id){
        return $this->conn->query("UPDATE users SET u_time = 0 WHERE u_id='$id'");
    }

    public function lastAction($id){
        $tm = time();
        return $this->conn->query("UPDATE $this->table SET u_time='$tm', u_last_act='$tm' WHERE u_id='$id'");
    }

}
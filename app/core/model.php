<?php

class Model
{
    protected $table;

    protected $servername;
    protected $username;
    protected $password;
    protected $db;
    protected $port;

    function __construct()
    {
        include "app/core/connect_db.php";

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db, $this->port);
    }
}
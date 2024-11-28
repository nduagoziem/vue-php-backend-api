<?php

namespace Config;

use mysqli;

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $connection;

    public function __construct($host, $dbname, $username, $password) {
        $this-> host = $host;
        $this-> dbname = $dbname;
        $this-> username = $username;
        $this-> password = $password;
    }

    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
        return $this->connection;
    }
}
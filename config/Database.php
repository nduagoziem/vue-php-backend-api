<?php

namespace Config;

use mysqli;

class Database
{
    private $host = "localhost";
    private $dbname = "xoftpay_invoice";
    private $username = "nduagoziem";
    private $password = "1234567890";
    public $connection;

    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
        return $this->connection;
    }
}
<?php

namespace Models;

class UserModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function findUserByUsername($username)
    {
        $query = "SELECT * FROM users WHERE userName = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function createUser($fullName, $userName, $hashedPassword)
    {
        $query = "INSERT INTO users (fullName, userName, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $fullName, $userName, $hashedPassword);
        return $stmt->execute();
    }
}
<?php

namespace Controllers;

class AuthController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function register($data)
    {
        session_start();

        $fullName = $data['fullName'];
        $userName = $data['userName'];
        $password = $data['password'];
        $confirmPassword = $data['confirmPassword'];

        if ($password !== $confirmPassword) {
            return ["success" => false, "message" => "Passwords do not match"];
        }

        if (strlen($password) < 8) {
            return ["success" => false, "message" => "Password must be at least 8 characters"];
        }

        $existingUser = $this->userModel->findUserByUsername($userName);
        if ($existingUser->num_rows > 0) {
            return ["success" => false, "message" => "Username already taken"];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $isCreated = $this->userModel->createUser($fullName, $userName, $hashedPassword);

        if ($isCreated) {
            $_SESSION['tokenKey'] = "t%20o%20k%20e%20n";
            $_SESSION['tokenValue'] = session_id();
            return [
                "success" => true,
                "message" => "Registration successful",
                "tokenKey" => $_SESSION['tokenKey'],
                "tokenValue" => $_SESSION['tokenValue'],
                "redirect" => "/dashboard"
            ];
        }

        return ["success" => false, "message" => "Error registering user"];
    }

    public function login($data)
    {
        session_start();

        $userName = $data['userName'];
        $password = $data['password'];

        $user = $this->userModel->findUserByUsername($userName);
        if ($row = $user->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['tokenKey'] = "t%20o%20k%20e%20n";
                $_SESSION['tokenValue'] = session_id();
                return [
                    "success" => true,
                    "message" => "Login successful",
                    "tokenKey" => $_SESSION['tokenKey'],
                    "tokenValue" => $_SESSION['tokenValue'],
                    "redirect" => "/dashboard"
                ];
            }
            return ["success" => false, "message" => "Incorrect password"];
        }

        return ["success" => false, "message" => "User not found"];
    }

    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        echo json_encode([
            "success" => true,
            "message" => "Logout Successful",
        ]);
    }
}
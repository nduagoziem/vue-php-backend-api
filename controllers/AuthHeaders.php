<?php

namespace Controllers;

class AuthHeaders
{
    public static function setHeaders()
    {
        header("Access-Control-Allow-Origin: http://localhost:4050"); // http://localhost:4050 is URL of the vue app
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
    }
}
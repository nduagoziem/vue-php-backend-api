<?php
require '../config/Database.php';
require '../controllers/AuthHeaders.php';
require '../models/UserModel.php';
require '../controllers/AuthController.php';

use Config\Database;
use Controllers\AuthHeaders;
use Models\UserModel;
use Controllers\AuthController;

AuthHeaders::setHeaders(); // Header function to handle CORS

$database = new Database("localhost", "xoftpay_invoice", "nduagoziem", "1234567890"); // Xampp user connection params
$conn = $database->connect();
$userModel = new UserModel($conn);
$authController = new AuthController($userModel);

if ($_SERVER['REQUEST_METHOD'] == "POST") { // Makes sure only POST requests are accepted in this file 
    $data = json_decode(file_get_contents('php://input'), true);
    $response = $authController->login($data);
    echo json_encode($response);
}
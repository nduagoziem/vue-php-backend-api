<?php
require '../controllers/AuthHeaders.php';
require '../controllers/AuthController.php';

use Controllers\AuthHeaders;
use Controllers\AuthController;

AuthHeaders::setHeaders();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // Makes sure only POST requests are accepted in this file
    AuthController::logout();
}
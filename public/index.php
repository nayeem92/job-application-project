<?php

require_once '../app/controllers/AuthController.php';

// An instance of AuthController
$controller = new AuthController();

// Determine the action based on the query parameter
$action = isset($_GET['action']) ? $_GET['action'] : 'register';

switch ($action) {
    case 'register':
        $controller->register();
        break;
    case 'login':
        $controller->login();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'step1':
        $controller->step1();
        break;
    case 'step2':
        $controller->step2();
        break;
    case 'step3':
        $controller->step3();
        break;
    case 'review':
        $controller->review();
        break;
    case 'submit':
        $controller->submit();
        break;
    default:
        header("Location: index.php?action=register");
        break;
}

<?php

$page = $_GET['page'] ?? 'users';

switch ($page) {
    case 'users':
        require_once __DIR__ . '/../app/Models/User.php';
        require_once __DIR__ . '/../app/Controllers/UserController.php';

        $controller = new UserController();
        $controller->index();
        break;

    default:
        include __DIR__ . '/../app/Views/404.php';
        break;
}

<?php

$page = $_GET['page'] ?? 'users';

switch ($page) {
    case 'users':
        require_once __DIR__ . '/../app/Models/User.php';
        require_once __DIR__ . '/../app/Controllers/UserController.php';

        $controller = new UserController();
        $controller->index();
        break;

    case 'user_create':
        require_once __DIR__ . '/../app/Models/User.php';
        require_once __DIR__ . '/../app/Controllers/UserController.php';

        $controller = new UserController();
        $controller->create();
        break;

    case 'user_store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/Models/User.php';
            require_once __DIR__ . '/../app/Models/Color.php';
            require_once __DIR__ . '/../app/Controllers/UserController.php';

            $controller = new UserController();
            $controller->store();
        } else {
            header('Location: index.php?page=user_create');
        }
        break;

    case 'user_edit':
        $id = $_GET['id'] ?? null;

        require_once __DIR__ . '/../app/Models/User.php';
        require_once __DIR__ . '/../app/Controllers/UserController.php';

        $controller = new UserController();
        $controller->edit($id);
        break;
    
    case 'user_delete':
        $id = $_GET['id'] ?? null;

        require_once __DIR__ . '/../app/Models/User.php';
        require_once __DIR__ . '/../app/Controllers/UserController.php';

        $controller = new UserController();
        $controller->delete($id);
        break;

    default:
        include __DIR__ . '/../app/Views/404.php';
        break;
}

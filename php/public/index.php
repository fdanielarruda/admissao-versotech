<?php

session_start();

require_once __DIR__ . '/../app/Controllers/UserController.php';

$userController = new UserController();

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$page = $page ?: 'users';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);


switch ($page) {
    case 'users':
        $userController->index();
        break;

    case 'user_create':
        $userController->create();
        break;

    case 'user_store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->store();
        } else {
            header('Location: index.php?page=user_create');
            exit;
        }
        break;

    case 'user_edit':
        if ($id) {
            $userController->edit($id);
        } else {
            header('Location: index.php?page=users');
            exit;
        }
        break;

    case 'user_update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->update();
        } else {
            header('Location: index.php?page=users');
            exit;
        }
        break;

    case 'user_delete':
        if ($id) {
            $userController->delete($id);
        } else {
            header('Location: index.php?page=users');
            exit;
        }
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/../app/Views/404.php';
        break;
}

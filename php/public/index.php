<?php
session_start();
require_once __DIR__ . '/../app/Controllers/UserController.php';

$page = $_GET['page'] ?? 'users';

switch ($page) {
    case 'users':
        (new UserController())->index();
        break;

    case 'user_create':
        (new UserController())->create();
        break;

    case 'user_store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new UserController())->store();
        } else {
            header('Location: index.php?page=user_create');
        }
        break;

    case 'user_edit':
        $id = $_GET['id'] ?? null;
        (new UserController())->edit($id);
        break;

    case 'user_update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new UserController())->update();
        } else {
            header('Location: index.php?page=user_create');
        }
        break;

    case 'user_delete':
        $id = $_GET['id'] ?? null;
        (new UserController())->delete($id);
        break;

    default:
        include __DIR__ . '/../app/Views/404.php';
        break;
}
